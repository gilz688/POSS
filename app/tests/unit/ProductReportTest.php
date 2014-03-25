<?php 

class ProductReportTest extends TestCase
{
    protected $useDatabase = true;

    /*
     * Tests testProductSale() function
    */
    public function testProductSale() {
        Auth::attempt($this->adminCredentials);
        $a = new ProductReport;
        $products = $a->getProduct();
        $expectedQuantity = [
            'Australian Karne Norte'=>387,
            'Gardenia Loaf Bread'=>299,
            'Shampoo'=>289,
            'Nissin Wafer'=>286,
            'Sports Drink'=>282
        ];
        $expectedSale = [
            'Shampoo'=> 393.25,
            'Sports Drink'=> 181.5,
            'Selecta Ice Cream' => 159.5,
            'Gardenia Loaf Bread' => 147.5,
            'Aficionado Body Spray' => 100.25
        ];

        $this->assertEquals($products[0],$expectedQuantity);
        $this->assertEquals($products[1], $expectedSale);
    }
}

    