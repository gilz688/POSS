<?php

class PurchasedItemTest extends TestCase {

    protected $useDatabase = true;
    


    public function test_AddPurchasedItem()
    {
		Auth::attempt($this->adminCredentials);
		$purchasedItemsData =  [
                'barcode' => 4807770270291,
                'quantity' => 3,
                'id' => 4
            ];

		 $purchasedItems = new PurchasedItemRepository;
		 $id = $purchasedItems->add($purchasedItemsData);		 
		 $this->assertEquals(4807770270291, $id);

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
                'id' => 4
            ];

		 $purchasedItems = new PurchasedItemRepository;
		 $purchasedItems->add($purchasedItemsData);
		 
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
                'id' => 4,
            ];

		 $purchasedItems = new PurchasedItemRepository;
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
                'id' => 4,
            ];

		 $purchasedItems = new PurchasedItemRepository;
		 $item = $purchasedItems->add($purchasedItemsData);
	}

	public function test_DeletePurchasedItem()
	{

		Auth::attempt($this->adminCredentials);
	    $items = new PurchasedItemRepository;
	    $barcode = 5200032482284;
	    
	    
	    $this->assertNotNull(PurchasedItem::find($barcode));
	    $items->delete($barcode);
        $this->assertNull(PurchasedItem::find($barcode));
	}
	
	/**
	 * @expectedException UnauthorizedException
	 */
	public function test_DeletePurchasedItem_UnauthorizedUser()
	{
		Auth::attempt($this->auditorCredentials);
	    $items = new PurchasedItemRepository;
	    $items->delete(5200032482284);
	}
	
	/**
	 * @expectedException ErrorException
     */
	public function test_DeletePurchasedItem_TransactionItemDoesNOtExists()
	{
		Auth::attempt($this->adminCredentials);
	    $items = new PurchasedItemsRepository;
		$items->delete(0000000000002);
	}
	
	public function test_EditPurchasedItem()
	{
		Auth::attempt($this->adminCredentials);
        $barcode = 5200032482284;
        $data = ['quantity' => 8];
        $items = new PurchasedItemRepository;
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
        $items = new PurchasedItemRepository;
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
        $items = new PurchasedItemRepository;
        $this->assertNull($items->find($barcode));
        $items->edit($barcode,$data);
	}



}
