<?php
 
namespace CT271\NLCS;

class Product{
    private $db;
	private $product_id = -1;
	public 	$product_name,$brand , $price, $category_id,$Image, $created_at, $updated_at, $amounts;
	private $errors = [];

	public function getProductId()
	{
		return $this->product_id;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data)
	{
		if (isset($data['product_id'])) {
			$this->product_id = trim($data['product_id']);
		}
		if (isset($data['product_name'])) {
			$this->product_name = trim($data['product_name']);
		}
		if (isset($data['brand'])) {
			$this->brand = trim($data['brand']);
		}
        if (isset($data['price'])) {
			$this->price = trim($data['price']);
		}
        if (isset($data['category_id'])) {
			$this->category_id = trim($data['category_id']);
		}
        if (isset($data['Image'])) {
			$this->Image = trim($data['Image']);
		}
		if (isset($data['amounts'])) {
			$this->amounts = trim($data['amounts']);
		}
		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

    public function validate()
    {
        if(!$this->product_name){
            $this->errors['product_name'] = 'Chưa nhập tên sản phẩm';
        }
        if (!$this->brand) {
            $this->errors['brand'] = 'Chưa chọn thương hiệu';
        }
        if (!$this->price) {
            $this->errors['price'] = 'Chưa nhập giá sản phẩm';
        }
        if (!$this->Image) {
            $this->errors['Image'] = 'Chưa chọn hình ảnh cho sản phẩm';
        }
        if (!$this->category_id) {
            $this->errors['category_id'] = 'Chưa chọn loại sản phẩm';
        }
        return empty($this->errors);
    }

	public function all()
	{
		$arr = [];
		$stmt = $this->db->prepare('select * from products');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$Products = new Product($this->db);
			$Products->fillFromDB($row);
			$arr[] = $Products;
		}
		return $arr;
	}

	public function find_all_category($category_id)
	{
		$arr = [];
		$stmt = $this->db->prepare('select * from products where category_id = :category_id');
		$stmt->execute(['category_id' => $category_id]);
		while ($row = $stmt->fetch()) {
			$Products = new Product($this->db);
			$Products->fillFromDB($row);
			$arr[] = $Products;
		}
		return $arr;
	}

	protected function fillFromDB(array $row)
	{
		[
			'product_id' => $this->product_id,
            'product_name' => $this->product_name,
			'brand' => $this->brand,
			'price' => $this->price,
            'category_id' => $this->category_id,
			'Image' => $this->Image,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		] = $row;
		return $this;
	}

	public function saveProducts()
	{
		$result = false;
		if ($this->product_id >= 0) {
			$stmt = $this->db->prepare('update products
			set product_name = :product_name, brand = :brand, price = :price, category_id = :category_id, Image = :Image, updated_at = now()
			where product_id = :product_id');
			$result = $stmt->execute([
				'product_id' => $this->product_id,
                'product_name' => $this->product_name,
				'brand' => $this->brand,
				'price' => $this->price,
				'category_id' => $this->category_id,
				'Image' => $this->Image
			]);
		} else {
			$stmt = $this->db->prepare('insert into products 
			(product_name, brand, price, category_id, Image)
			values (:product_name, :brand, :price, :category_id, :Image)');
			$result = $stmt->execute([
                'product_name' => $this->product_name,
				'brand' => $this->brand,
				'price' => $this->price,
				'category_id' => $this->category_id,
				'Image' => $this->Image
			]);
			if ($result) {
				$this->product_id = $this->db->lastInsertId();
			}
		}
		return $result;
	}

	public function saveProducts_like($user_id,$product_id)
	{
		$result = false;
		$sql = $this->db->prepare("select * from likes where user_id = ? and product_id = ?");
			$sql->execute([
				$_POST['user_id'],
				$_POST['product_id']
			]);
			if ($sql->rowCount() > 0) {
				echo "<script>alert('Đã thích sản phẩm!')</script>";
			}
			else{
				$stmt = $this->db->prepare('insert into likes 
				(user_id, product_id)
				values (:user_id, :product_id)');
				$result = $stmt->execute([
					'user_id' => $user_id,
					'product_id' => $product_id
				]);
				if ($result) {
					$this->product_id = $this->db->lastInsertId();
				}
				echo "<script>alert('Đã thêm sản phẩm vào yêu thích!')</script>";
			}
		return $result;
	}

	public function products_like($user_id)
	{
		$arr = [];
		$stmt = $this->db->prepare('select p.* from likes l join products p on l.product_id = p.product_id where user_id = :user_id');
		$stmt->execute(['user_id' => $user_id]);
		while ($row = $stmt->fetch()) {
			$Products = new Product($this->db);
			$Products->fillFromDB($row);
			$arr[] = $Products;
		}
		return $arr;
	}

	public function delete_like($product_id)
	{
		$stmt = $this->db->prepare('delete from likes where product_id = :product_id');
		return $stmt->execute(['product_id' => $product_id]);
	}

	public function find($product_id)
	{
		$stmt = $this->db->prepare('select * from products where product_id = :product_id');
		$stmt->execute(['product_id' => $product_id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		}
		return null;
	}

	public function search($str)
	{
		$arr = [];
		$stmt = $this->db->prepare("
			SELECT * FROM products
			WHERE product_name LIKE :str
		");
		$stmt->execute(['str' => '%' . $str . '%']);
		while ($row = $stmt->fetch()) {
			$product = new Product($this->db);
			$product->fillFromDB($row);
			$arr[] = $product;
		}
		return $arr;
	}

	public function FindByFilter($List_products){
		if(isset($_POST['price_bot']) && isset($_POST['price_top']) && ($_POST['price_bot']!=0 || $_POST['price_top']!=0)){
			$price_bot = filter_var(($_POST['price_bot']), FILTER_SANITIZE_NUMBER_INT); // Lọc bỏ tất cả các ký tự không phải số
			$price_top = filter_var(($_POST['price_top']), FILTER_SANITIZE_NUMBER_INT); // Lọc bỏ tất cả các ký tự không phải số
			$List_products_filter = array_filter($List_products, function ($product) use ($price_bot, $price_top){
				return $product->price >= $price_bot && $product->price <= $price_top;
			});// Lọc tất cả các sản phẩm lớn hơn price_bot và nhỏ hơn price_top
		}
		
		if(isset($_POST['brand'])){
			$brand_select = $_POST['brand'];
			if(isset($List_products_filter)){ // Nếu có danh sách sản phẩm đã lọc thì lọc tiếp trên danh sách đó
				$List_products_filter = array_filter($List_products_filter, function ($product) use ($brand_select) {
					return in_array($product->brand, $brand_select); // Lọc tất cả các sản phẩm có brand trong mảng brand đã chọn
				});
			}else {
				$List_products_filter = array_filter($List_products, function ($product) use ($brand_select) {
					return in_array($product->brand, $brand_select);// Lọc tất cả các sản phẩm có brand trong mảng brand đã chọn
				});
			}
		}	
		return $List_products_filter;
	}


	public function update(array $data)
	{
		$this->fill($data);
		if ($this->validate()) {
			return $this->saveProducts();
		}
		return false;
	}


	public function delete()
	{
		$stmt = $this->db->prepare('delete from products where product_id = :product_id');
		return $stmt->execute(['product_id' => $this->product_id]);
	}
}

