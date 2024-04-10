<?php
 
namespace CT271\NLCS;

class User{
    private $db;
	private $user_id = -1;
	public $username, $full_name, $phone_number, $password, $rpassword, $email, $created_at, $updated_at, $registerCheck;
	private $errors = [];

	public function getUserId()
	{
		return $this->user_id;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data)
	{
		$fillableFields = ['username', 'email', 'password', 'phone_number', 'rpassword', 'full_name', 'registerCheck'];

		foreach ($fillableFields as $field) {
			if (isset($data[$field])) {
				$this->$field = trim($data[$field]);
			}
		}
		return $this;
}

	public function getValidationErrors()
	{
		return $this->errors;
	}

	public function validate()
	{
		if (!$this->email) {
			$this->errors['email'] = 'Chưa nhập email!';
		} else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$this->errors['email'] = 'Email không hợp lệ!';
		} else if ($this->db->query("select * from users where email = '$this->email'")->rowCount() > 0) {
			$this->errors['email'] = 'Email đã được sử dụng!';
		}
		if (!$this->username) {
			$this->errors['username'] = 'Chưa nhập username!';
		} else if ($this->db->query("select * from users where username = '$this->username'")->rowCount() > 0) {
			$this->errors['username'] = 'Username đã được sử dụng';
		}
		if (!$this->full_name) {
			$this->errors['full_name'] = 'Chưa nhập full_name!';
		} 
		if (!$this->phone_number) {
			$this->errors["phone_number"] = "Bạn chưa nhập số điện thoại";
		} else if (strlen($this->phone_number) != 10) {
			$this->errors["phone_number"] = "Số điện thoại không hợp lệ";
		}
		if (!$this->password) {
			$this->errors["password"] = "Bạn chưa nhập mật khẩu";
		} else if (strlen($this->password) < 8) {
			$this->errors["password"] = "Mật khẩu phải lớn hơn hoặc bằng 8 ký tự";
		}
		if (!$this->rpassword) {
			$this->errors["rpassword"] = "Bạn chưa nhập lại mật khẩu";
		} else if ($this->password != $this->rpassword) {
			$this->errors["rpassword"] = "Mật khẩu không khớp";
		}
		if (!$this->registerCheck) {
			$this->errors["registerCheck"] = "Bạn phải đồng ý với điều kiện!";
		}
		return empty($this->errors);
	}

	public function validateEdit()
	{
		if (!$this->full_name) {
			$this->errors['full_name'] = 'Chưa nhập full_name!';
		} 
		if (!$this->phone_number) {
			$this->errors["phone_number"] = "Bạn chưa nhập số điện thoại";
		} else if (strlen($this->phone_number) != 10) {
			$this->errors["phone_number"] = "Số điện thoại không hợp lệ";
		}
		if (!$this->password) {
			$this->errors["password"] = "Bạn chưa nhập mật khẩu";
		} else if (strlen($this->password) < 8) {
			$this->errors["password"] = "Mật khẩu phải lớn hơn hoặc bằng 8 ký tự";
		}
		if (!$this->rpassword) {
			$this->errors["rpassword"] = "Bạn chưa nhập lại mật khẩu";
		} else if ($this->password != $this->rpassword) {
			$this->errors["rpassword"] = "Mật khẩu không khớp";
		}

		return empty($this->errors);
	}

	public function validateLogin($username, $password)
	{
		if (!$username) {
			$this->errors["username"] = "Bạn chưa nhập username!";
		} 
		else {
			$this->errors["username"] = "";
		}
		if (!$password) {
			$this->errors["password"] = "Bạn chưa nhập mật khẩu!";
		} else if (strlen($_POST['password']) < 8) {
			$this->errors["password"] = "Mật khẩu không hợp lệ!(Phải trên 8 ký tự)";
		} else {
			$this->errors["password"] = "";
		}

		if ($this->errors["username"] == "" &&  $this->errors["password"] == "") {
			$sql = $this->db->prepare("select * from users where username = ?");
			$sql->execute([$_POST['username']]);
			if ($sql->rowCount() > 0) {
				$result = $sql->fetch();
				if(password_verify($_POST['password'],$result['password'])){
					$_SESSION["userID"] = $result["user_id"];
					header("Location: ?action=home");
				} else{
					$this->errors["invalid"] = "Username hoặc mật khẩu không chính xác!";
				}
				
			} else {
				$this->errors["invalid"] = "Username hoặc mật khẩu không chính xác!";
			}
		}

	}

	public function all()
	{
		$arr = [];
		$stmt = $this->db->prepare('select * from users');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$User = new User($this->db);
			$User->fillFromDB($row);
			$arr[] = $User;
		}
		return $arr;
	}


	protected function fillFromDB(array $row)
	{
		[
			'user_id' => $this->user_id,
            'username' => $this->username,
			'email' => $this->email,
			'password' => $this->password,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
			'full_name' => $this->full_name,
			'phone_number' => $this->phone_number
		] = $row;
		return $this;
	}

	public function saveUser()
	{
		$result = false;
		if ($this->user_id >= 0) {
			$stmt = $this->db->prepare('update users
			set full_name= :full_name, phone_number= :phone_number, updated_at = now()
			where user_id = :user_id');
			$result = $stmt->execute([
				'user_id' => $this->user_id,
				'full_name' => $this->full_name,
                'phone_number' => $this->phone_number
			]);
		} else {
			$password = password_hash($this->password, PASSWORD_DEFAULT);
			$stmt = $this->db->prepare('insert into users 
			(username, full_name, phone_number, email, password)
			values (:username, :full_name, :phone_number, :email, :password)');
			$result = $stmt->execute([
                'username' => $this->username,
				'full_name' => $this->full_name,
                'phone_number' => $this->phone_number,
				'email' => $this->email,
				'password' => $password
			]);
			if ($result) {
				$this->user_id = $this->db->lastInsertId();
			}
		}
		return $result;
	}

	public function find($user_id)
	{
		$stmt = $this->db->prepare('select * from users where user_id = :user_id');
		$stmt->execute(['user_id' => $user_id]);
		if ($row = $stmt->fetch()) {
			$this->fillFromDB($row);
			return $this;
		}
		return null;
	}

	public function update(array $data)
	{
		$this->fill($data);
		if ($this->validateEdit()) {
			return $this->saveUser();
		}
		return false;
	}

	public function update_password(array $data)
	{
		$this->fill($data);
		if ($this->validateEdit()) {
			$password = password_hash($this->password, PASSWORD_DEFAULT);
			$stmt = $this->db->prepare('update users
			set password= :password, updated_at = now()
			where user_id = :user_id');
			$result = $stmt->execute([
				'user_id' => $this->user_id,
				'password' => $password
			]);
			return $result;
		}
		return false;
	}
	


	public function delete()
	{
		$stmt1 = $this->db->prepare('delete from likes where user_id = :user_id');
		$result = $stmt1->execute(['user_id' => $this->user_id]);
		$stmt = $this->db->prepare('delete from users where user_id = :user_id');
		return $stmt->execute(['user_id' => $this->user_id]);
	}
}

