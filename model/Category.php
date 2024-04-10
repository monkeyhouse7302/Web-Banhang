<?php
 
namespace CT271\NLCS;

class Category{
    private $db;
	private $category_id = -1;
	public 	$category_name;

	public function getCategoryId()
	{
		return $this->category_id;
	}

	public function __construct($pdo)
	{
		$this->db = $pdo;
	}

	public function fill(array $data)
	{
		if (isset($data['product_id'])) {
			$this->category_id = trim($data['category_id']);
		}
		if (isset($data['product_name'])) {
			$this->category_name = trim($data['category_name']);
		}
		return $this;
	}

	public function getValidationErrors()
	{
		return $this->errors;
	}

    public function validate()
    {
        if (!$this->category_id) {
            $this->errors['category_id'] = 'Chưa chọn loại sản phẩm';
        }
        return empty($this->errors);
    }

	public function all()
	{
		$arr = [];
		$stmt = $this->db->prepare('select * from category');
		$stmt->execute();
		while ($row = $stmt->fetch()) {
			$category = new Category($this->db);
			$category->fillFromDB($row);
			$arr[] = $category;
		}
		return $arr;
	}

	protected function fillFromDB(array $row)
	{
		[
			'category_id' => $this->category_id,
            'category_name' => $this->category_name
		] = $row;
		return $this;
	}
}