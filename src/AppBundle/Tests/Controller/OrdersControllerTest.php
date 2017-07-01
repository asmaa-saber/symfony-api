<?php

namespace AppBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class OrdersControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->fixtures = $this->loadFixtures([
            'AppBundle\DataFixtures\ORM\LoadCategories',
            'AppBundle\DataFixtures\ORM\LoadCollections',
            'AppBundle\DataFixtures\ORM\LoadCustomers',
            'AppBundle\DataFixtures\ORM\LoadPaymentMethods',
            'AppBundle\DataFixtures\ORM\LoadSubcategories',
        ])->getReferenceRepository();
    }

    private function postJson($uri, $data)
    {
        $headers = array('CONTENT_TYPE' => 'application/json');
        $json = json_encode($data);
        $client = static::createClient();
        $client->request('POST', $uri, array(), array(), $headers, $json);

        return $client->getResponse();
    }

    private function prepareOrderDataArray($amount, $shippingCost, $firstItemCollectionId, $secondItemCollectionId)
    {
        return [
            'parameters' =>
            [
                'order' =>
                [
                    'order_id' => 51275,
                    'email' => $this->fixtures->getReference("smith")->getEmail(),
                    'total_amount_net' => $amount,
                    'shipping_costs' => $shippingCost,
                    'payment_method' => $this->fixtures->getReference("visa")->getName(),
                    'items' =>
                        [
                            [
                                'name' => 'Item1',
                                'qnt' => 1,
                                'value' => 1100,
                                'category' => $this->fixtures->getReference("fashion-category")->getName(),
                                'subcategory' => $this->fixtures->getReference("jacket-subcategory")->getName(),
                                'tags' => ['porsche','design'],
                                'collection_id' => $firstItemCollectionId
                            ],
                            [
                                'name' => 'Item2',
                                'qnt' => 1,
                                'value' => 790,
                                'category' => $this->fixtures->getReference("watches-category")->getName(),
                                'subcategory' => $this->fixtures->getReference("sport-subcategory")->getName(),
                                'tags' => ['watch', 'porsche', 'electronics'],
                                'collection_id' => $secondItemCollectionId
                            ],
                        ]
                ]
            ]
        ];
    }

    public function testValidOrderCreation()
    {
        $data = $this->prepareOrderDataArray(
                    210,
                    10,
                    $this->fixtures->getReference("discount-collection")->getId(),
                    $this->fixtures->getReference("no-discount-collection")->getId()
                );
        $response = $this->postJson('/api/v1/orders.json', $data);
        $this->assertEquals($response->getStatusCode(), Response::HTTP_CREATED);
    }

    public function testInvalidOrder()
    {
        $data = $this->prepareOrderDataArray(
            'non-numeric-amount',
            10,
            $this->fixtures->getReference("discount-collection")->getId(),
            $this->fixtures->getReference("no-discount-collection")->getId()
        );
        $response = $this->postJson('/api/v1/orders.json', $data);
        $this->assertEquals($response->getStatusCode(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
