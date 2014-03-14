<?php

class PurchasedItemTest extends TestCase {

    protected $useDatabase = true;
    


    public function test_AddPurchasedItem()
    {
		Auth::attempt($this->adminCredentials);
		$purchasedItemsData =  [
                'barcode' => 4807770270291,
                'quantity' => 3,
                'transaction_id' => 4
            ];

		 $purchasedItems = new PurchasedItemsRepository;
		 $purchasedItems->add($purchasedItemsData);
		 $item = $purchasedItems->find($purchasedItemsData['barcode']);
		 $this->assertEquals(4807770270291, $item['barcode']);

	}
	
	/**
	 * @expectedException UnauthorizedException
     */
	 public function test_AddPurchasedItem_UnauthorizedUser()
    {
		Auth::attempt($this->auditorCredentials);
		$purchasedItemsData =  [
                'barcode' => 4807770270291,
                'quantity' => 3,
                'transaction_id' => 4
            ];

		 $purchasedItems = new PurchasedItemsRepository;
		 $purchasedItems->add($purchasedItemsData);
		 $item = $purchasedItems->find($purchasedItemsData['barcode']);
	}
	
	/**
	 * @expectedException ErrorException
     */
	 public function test_AddPurchasedItem_InvalidData()
    {
		Auth::attempt($this->adminCredentials);
		$purchasedItemsData =  [
                'barcode' => 4807770270291,
                'quantity' => 3,
                'transaction_id' => 4,
            ];

		 $purchasedItems = new PurchasedItemsRepository;
		 $item = $purchasedItems->add();
	}
	
	/**
	 * @expectedException ErrorException
     */
	 public function test_AddPurchasedItem_Blank()
    {
		Auth::attempt($this->adminCredentials);
		$purchasedItemsData =  [
                'barcode' => 4807770270291,
                'quantity' => hello,
                'transaction_id' => 4,
            ];

		 $purchasedItems = new PurchasedItemsRepository;
		 $item = $purchasedItems->add($purchasedItemsData);
	}

	public function test_DeletePurchasedItem()
	{
		Auth::attempt($this->adminCredentials);
		$barcode = 5200032482284;
	    $items = new PurchasedItemsRepository;
	    $this->assertNotNull($items->find($barcode));
	    $items->delete($barcode);
        $this->assertNull($items->find($barcode));
	}
	
	/**
	 * @expectedException UnauthorizedException
	 */
	public function test_DeletePurchasedItem_UnauthorizedUser()
	{
		Auth::attempt($this->auditorCredentials);
	    $items = new PurchasedItemsRepository;
	    $items->delete(5200032482284);
	}
	
	/**
	 * @expectedException ErrorException
     */
	public function test_DeletePurchasedItem_TransactionItemDoesNOtExists()
	{
		Auth::attempt($this->adminCredentials);
	    $items = new PurchasedItemsRepository;
		$items->delete(0000000000001);
	}
	
	public function test_EditPurchasedItem()
	{
		Auth::attempt($this->adminCredentials);
        $barcode = 5200032482284;
        $data = ['quantity' => 8];
        $items = new PurchasedItemsRepository;
        $this->assertNotNull($items->find($barcode));
        $items->edit($barcode,$data);
        $attributes = $items->find($barcode);
        $this->assertEquals(8,$attributes['quantity']);
	}
	
	/*
	 * @expectedException UnauthorizedException
	 * */
	public function test_EditPurchasedItem_NotLoggedIn()
	{
		Auth::attempt($this->auditorCredentials);
	}
	
	/**
	 * @expectedException ErrorException
     */
	public function test_EditPurchasedItem_InvalidData()
	{
		Auth::attempt($this->adminCredentials);
        $barcode = 5200032482284;
        $data = ['quantity' => hello];
        $items = new PurchasedItemsRepository;
        $this->assertNotNull($items->find($barcode));
        $items->edit($barcode,$data);
	}
	
	/**
	 * @expectedException ErrorException
     */
	public function test_EditPurchasedItem_TransactionDoesNOtExists()
	{
		Auth::attempt($this->adminCredentials);
        $barcode = 5200032482285;
        $data = ['quantity' => 4];
        $items = new PurchasedItemsRepository;
        $this->assertNull($items->find($barcode));
        $items->edit($barcode,$data);
	}



}
