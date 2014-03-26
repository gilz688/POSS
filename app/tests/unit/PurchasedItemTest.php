<?php

class PurchasedItemTest extends TestCase {

    protected $useDatabase = true;
    


    public function test_AddPurchasedItem()
    {
		Auth::attempt($this->adminCredentials);
		$purchasedItemsData =  [
                'barcode' => 4807770270291,
                'quantity' => 3,
                'id' => 490
            ];

		 $purchasedItems = new PurchasedItemRepository;
		 $barcode = $purchasedItems->add($purchasedItemsData);		 
		 $this->assertEquals(4807770270291, $barcode);

	}
	
	public function test_AddInventoryItemQuantity(){		
		Auth::attempt($this->clerkCredentials);

		$purchasedItemsData =  [
                'barcode' => 4800119220803,
                'quantity' => 3,
                'id' => 4
            ];

		 $purchasedItems = new PurchasedItemRepository;
		 $barcode = $purchasedItems->add($purchasedItemsData);
		 
		 
		  $inventory_item = Item::find($barcode);
            $old_quantity = $inventory_item->quantity;
            $new_quantity = $old_quantity - $purchasedItemsData['quantity'];
            $inventory_item->quantity = $new_quantity;
            $inventory_item->update();
            
            $this->assertEquals($new_quantity,$inventory_item->quantity);
		 
	}
	
	/**
	 * @expectedException ErrorException
     */
	public function test_AddInventoryItemQuantityNotEnough(){
		Auth::attempt($this->clerkCredentials);

		$purchasedItemsData =  [
                'barcode' => 4807770270291,
                'quantity' => 100,
                'id' => 4
            ];

		 $purchasedItems = new PurchasedItemRepository;
		 $barcode = $purchasedItems->add($purchasedItemsData);
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
                'barcode' => '',
                'quantity' => 5,
                'id' => 4,
            ];

		 $purchasedItems = new PurchasedItemRepository;
		 $item = $purchasedItems->add($purchasedItemsData);
	}

	/**
	 * @expectedException ErrorException
	 */
	public function test_DeletePurchasedItem()
	{

		Auth::attempt($this->clerkCredentials);
	    $items = new PurchasedItemRepository;	
	    $barcode = 4806517213096;
		//$this->assertNotNull($items->find($barcode));
		$items->delete($barcode);
        //$this->assertNull($items->find($barcode));
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
     
	public function test_DeletePurchasedItem_TransactionItemDoesNOtExists()
	{
		Auth::attempt($this->adminCredentials);
	    $items = new PurchasedItemRepository;
		$items->delete(0000000000002);
	}*/
	
	




}
