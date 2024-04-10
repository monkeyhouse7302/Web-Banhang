<?php
 
namespace CT271\NLCS;

class Order{
    private $db;
	private $order_id = -1;
	public $full_name, $phone_number, $email, $address, $payment, $note, $product_id, $amounts, $total_price,  $status, $created_at, $updated_at;
	private $errors = [];

	public function getOrderId()
	{
		return $this->order_id;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data)
	{
		$fillableFields = ['full_name', 'email', 'address', 'phone_number', 'payment', 'note', 'product_id','amounts', 'total_price', 'status'];

        foreach ($fillableFields as $field) {
            if (isset($data[$field])) {
                $this->$field = trim($data[$field]);
            }
        }
		return $this;
	}


	public function all()
	{
		$arr = [];
		$stmt = $this->db->prepare('select * from orders');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$Order = new Order($this->db);
			$Order->fillFromDB($row);
			$arr[] = $Order;
		}
		return $arr;
	}

	protected function fillFromDB_details(array $row)
	{
		[
			'order_id' => $this->order_id,
            'product_id' => $this->product_id,
			'amounts' => $this->amounts,
		] = $row;
		return $this;
	}

	protected function fillFromDB(array $row)
	{
		[
			'order_id' => $this->order_id,
            'full_name' => $this->full_name,
			'email' => $this->email,
			'phone_number' => $this->phone_number,
            'address' => $this->address,
            'payment' => $this->payment,
			'note' => $this->note,
			'total_price' => $this->total_price,
            'status' => $this->status,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		] = $row;
		return $this;
	}

	public function saveOrder()
	{
		$result = false;
		if ($this->order_id >= 0) {
			$stmt = $this->db->prepare('update orders
			set status = :status, updated_at = now()
			where order_id = :order_id');
			$result = $stmt->execute([
				'order_id' => $this->order_id,
                'status' => $this->status
			]);
		} else {
			$stmt = $this->db->prepare('insert into orders 
			(full_name, phone_number, email, address, payment, note, total_price, status)
			values (:full_name, :phone_number, :email, :address, :payment, :note, :total_price, :status)');
			$result = $stmt->execute([
				'full_name' => $this->full_name,
                'phone_number' => $this->phone_number,
				'email' => $this->email,
				'address' => $this->address,
                'payment' => $this->payment,
                'note' => $this->note,
				'total_price' => $this->total_price,
				'status' => $this->status
			]);
			if ($result) {
				$this->order_id = $this->db->lastInsertId();
			}
		}
		return $result;
	}
	public function saveOrder_Detail($order_id, $product_id, $amounts)
	{
		$result = false;
			$stmt = $this->db->prepare('insert into orders_detail 
			(order_id, product_id, amounts)
			values (:order_id, :product_id, :amounts)');
			$result = $stmt->execute([
				'order_id' => $order_id,
                'product_id' => $product_id,
				'amounts' => $amounts
			]);
		return $result;
	}

	public function find($order_id)
	{
		$stmt = $this->db->prepare('select * from orders where order_id = :order_id');
		$stmt->execute(['order_id' => $order_id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		}
		return null;
	}

	public function find_orders_detail($order_id)
	{
		$arr = [];
		$stmt = $this->db->prepare('select * from orders_detail where order_id = :order_id');
		$stmt->execute(['order_id' => $order_id]);
		while ($row = $stmt->fetch()) {
			$order_detail = new Order($this->db);
			$order_detail->fillFromDB_details($row);
			$arr[] = $order_detail;
		}
		return $arr;
	}	

	public function find_orders_user($email) {
		$arr = [];
		$stmt = $this->db->prepare("
			SELECT * FROM orders
			WHERE email = :email
		");
		$stmt->execute(['email' => $email]);
		while ($row = $stmt->fetch()) {
			$order = new Order($this->db);
			$order->fillFromDB($row);
			$arr[] = $order;
		}
		return $arr;
	}

	public function find_orders_status($status) {
		$arr = [];
		$stmt = $this->db->prepare("
			SELECT * FROM orders
			WHERE status = :status
		");
		$stmt->execute(['status' => $status]);
		while ($row = $stmt->fetch()) {
			$order = new Order($this->db);
			$order->fillFromDB($row);
			$arr[] = $order;
		}
		return $arr;
	}

	public function getIncome() {
		$income = 0;
		$stmt = $this->db->prepare("
			SELECT SUM(total_price) AS income FROM orders
			WHERE status = :status
		");
		$stmt->execute(['status' => 'Đã giao']);
	
		$result = $stmt->fetch();
		if ($result && isset($result['income'])) {
			$income = $result['income'];
		}
	
		return $income;
	}

	

	public function update(array $data)
	{
		$this->fill($data);
			return $this->saveUser();
		return false;
	}

	public function update_status_order($order_id ,$status) {
		$stmt = $this->db->prepare('update orders
        set status = :status, updated_at = now()
        where order_id = :order_id');
		$stmt->execute([
            'order_id'=> $order_id,
            'status' => $status
        ]);
	}


	public function delete()
	{
		$stmt = $this->db->prepare('delete from orders_detail where order_id = :order_id');
        $result1 = $stmt->execute(['order_id' => $this->order_id]);

        $stmt = $this->db->prepare('delete from orders where order_id = :order_id');
        $result2 = $stmt->execute(['order_id' => $this->order_id]);
        return $result1 && $result2;
	}
}

