<?php

/**
* Collect the rates based on Category and Product
*
* @author      Oscprofessionals Team (support@oscprofessionals.com)
* @copyright   Copyright (c) 2014 Oscprofessionals (http://www.oscprofessionals.com)
* @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*
* @category    Oscprofessionals
* @package     Oscprofessionals_Flatship
*/

class Oscprofessionals_Flatship_Model_Carrier_Oscpflatshiprate
    extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface {

    /**
     * Carrier's code
     *
     * @var string
     */
    protected $_code = 'oscpflatshiprate';

    /**
     * Whether this carrier has fixed rates calculation
     *
     * @var bool
     */
    protected $_isFixed = true;

    /**
     * Default condition name
     *
     * @var string
     */
    protected $_default_condition_name = 'products';

     /**
     * Collect and get rates
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Rate Result|Method|Price
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {

      // return if module disable
      if(!Mage::helper('oscpflatshiprate')->isEnable()){
        return false;
      }
         //Add shipping Title
         $shippingTitle = $this->getConfigData('title');

         //Add shipping Name
         $methodTitle = $this->getConfigData('name');

         //Add shipping Default Price
         $shippingRate = $this->getConfigData('price');

         //shipping Mode type category/product
         $shippingMode = Mage::helper('oscpflatshiprate')->getMode();

         // if not shipping mode the set default
         $shippingMode = $shippingMode ? $shippingMode : $this->_default_condition_name;

         // get customer group Enable
         $customerGroupEnable = Mage::helper('oscpflatshiprate')->isAllowedCustomerGroup();

         //collect selected customer group id
         $shipCustomerGroupId = Mage::helper('oscpflatshiprate')->getCustomerGroupId();
         $shipCustomerIdArray = explode(',',$shipCustomerGroupId);


         //get allow country status.
         $allowscountry = $this->getConfigData('sallowspecific');

         //get session customer group id
         $customerGroupId = Mage::getSingleton('customer/session')->getCustomerGroupId();

        try {
            $shippingPrice = '';

                switch ($shippingMode){

                      case 'category':
                           if((!in_array($customerGroupId,$shipCustomerIdArray)) && ($customerGroupEnable==1)){
                                   return false;
                          }else{
                             //category based shipping rate
                             $shippingPrice = $this->_collectCategoryRates($request);

                          }
                      break;

                      default:
                           if((!in_array($customerGroupId,$shipCustomerIdArray)) && ($customerGroupEnable==1)){
                                   return false;
                          }else{
                             //product based shipping rate
                             $shippingPrice = $this->_collectProductRates($request);

                          }
                      break;

                }


           if ((isset($shippingPrice) && $shippingPrice == '') || (!isset($shippingPrice))) {
                $shippingPrice = $shippingRate;
            }

            $result = $this->_getModel('shipping/rate_result');
            $method = $this->_getModel('shipping/rate_result_method');
            $method->setCarrier($this->_code);
            $method->setCarrierTitle($shippingTitle);
            $method->setMethod($this->_code);
            $method->setMethodTitle($methodTitle);
            $method->setPrice($shippingPrice);

            $result->append($method);
            return $result;

        } catch (Exception $e) {
           Mage::printException($e);
        }

    }

     /**
     * Get Model
     *
     * @param string $modelName
     *
     * @return Mage_Core_Model_Abstract
     */
    protected function _getModel($modelName)
    {
        return Mage::getModel($modelName);
    }

    /**
    * Collect categories shipping rates
    *
    * @Param  Mage_Shipping_Model_Rate_Request $request
    * @return Category Rate
    *
    */
    private function _collectCategoryRates($request)
   {

      $shipPrice = '';
      //Add shipping Default Price
      $shippingRateDefault = $this->getConfigData('price');
      //get shipping category priority
      $categoryPriority = $this->getConfigData('categorypriority');
        if ($request->getAllItems()) {
           foreach ($request->getAllItems() as $item) {
             if ($item->getHasChildren()) {
                    $productSku = $item->getProduct()->getData('sku');
             } else {
                    $productSku = $item->getSku();
             }

           if(!$item->getProduct()->isConfigurable()){

              $_product = $this->_getModel('catalog/product')
              ->loadByAttribute('sku', $productSku);

              $cartProductCatId = $_product->getCategoryIds();

           $count =0;
           $indivShipPrice = array();
           $cateShippingPriceFinal = '';
            foreach ($cartProductCatId as $categoryID) {
                $cateShippingPrice = '';
                $categoryData = $this->_getModel("catalog/category")
                ->load($categoryID);
                $cateShippingPrice = $categoryData['shipping_cost'];

                //if shiiping cost is set then store the shipping cost of each category in $indivShipPrice array
                if($cateShippingPrice !=''){
                    $cateShippingPriceFinal = $cateShippingPrice;
                    $indivShipPrice[] = $cateShippingPriceFinal;
                }
                //Set shipping method price as per the category priority selected i.e. high or low
                if($count > 0 && isset($cateShippingPrice) && $cateShippingPrice!=''){
                    //Mage::log('',null,);

                   if($categoryPriority == 1){

                        $shipPrice = max(array_values($indivShipPrice));
                    }
                   elseif($categoryPriority == 0){

                        $shipPrice = min(array_values($indivShipPrice));
                    }
                }
                elseif(isset($cateShippingPrice) && $cateShippingPrice!='' && ($cateShippingPrice>0)){

                        $shipPrice = $cateShippingPrice;
                 }
                elseif(!isset($cateShippingPrice) && $cateShippingPrice==''){
                        $shipPrice = (float)$shippingRateDefault;
                }
                $count++;
            }

               $shippingPrice += (float)$shipPrice;
            }

         }
            //Mage::log("Query cat: ".print_r($indivShipPrice, true),null,'tt1.log');
      }
    return $shippingPrice;
    }


    /**
    * Collect products shipping rates
    *
    * @Param  Mage_Shipping_Model_Rate_Request $request
    * @return Product Rate
    *
    */
    private function _collectProductRates($request)
   {
      Mage::log('product rate',Zend_log::INFO,'layout.log',true);
      $shippingNotAppliedOn = "Construction Equipments";
      //0=> not depned on qty , 1=>Yes multiply with qty.
      $shippingQtyBased = $this->getConfigData('shippingqty_base');
      //Add shipping Default Price
      $shippingRateDefault = 0;
      $shippingPrice = 0;
      $shippingPriceProduct = 0;
      $productShippingCost = 0;
      $vendors = array();
       if ($request->getAllItems()) {

           foreach ($request->getAllItems() as $item) {
               if(!$item->getProduct()->isConfigurable()){
            $productShippingCost = 0;
            //get product order quantity
            $productOrderQty = $item->getQty();

            if ($item->getHasChildren()) {
                    $productSku = $item->getProduct()->getData('sku');
             } else {
                    $productSku = $item->getSku();
             }
             $_product = $this->_getModel('catalog/product')->loadByAttribute('sku', $productSku);

//--start
$categoryIds = $_product->getCategoryIds();
if(count($categoryIds) ){
         $firstCategoryId = $categoryIds[1];
         $_category = Mage::getModel('catalog/category')->load($firstCategoryId);
     }
//  Mage::log(($_category->getName() == "Construction Equipment"),Zend_log::INFO,'layout.log',true);
//  Mage::log(($_category->getName() == 'Construction Equipment'),Zend_log::INFO,'layout.log',true);
             if(!empty($_product['vendor']) && isset($_product['vendor']) && ($_category->getName() != $shippingNotAppliedOn)){


                $products = $_product->getData();
                    if(!empty($products['shipping_cost']) && isset($products['shipping_cost'])){
                         $productShippingCost = $products['shipping_cost'];
                     } else {
                         $shippingRateDefault = $this->getConfigData('price');
                         $productShippingCost = $shippingRateDefault;

                     }
            Mage::log($_category->getName(),Zend_log::INFO,'layout.log',true);
                  if(array_key_exists($_product['vendor'],$vendors)){
// Mage::log('in array  '.$vendors[$_product['vendor']].' new shipp '.$_product['shipping_cost'],Zend_log::INFO,'layout.log',true);
                            if($vendors[$_product['vendor']] <  $productShippingCost){
                              $vendors[$_product['vendor']] = $productShippingCost ;
                            }
                  }else{
                      $vendors[$_product['vendor']] = $productShippingCost;
                  }
//   Mage::log($vendors,Zend_log::INFO,'layout.log',true);
              }

          //   Mage::log($_product->debug(),Zend_log::INFO,'layout.log',true);

  //--end

          /*     if ($shippingQtyBased == 1) {
                  //Multiply with product qty
                   $shippingPriceProduct = $productShippingCost * $productOrderQty;
               }else{
                   //Not with product qty
                   $shippingPriceProduct = $productShippingCost;
               }*/
              //  $shippingPrice += (float)$shippingPriceProduct;
               }
           }

           if(count($vendors)>2){
             $shippingPrice = count($vendors) * 250;
           }else if(count($vendors)>0){
    //          Mage::log('aray len:es.: '.count($vendors),Zend_log::INFO,'layout.log',true);
             foreach ($vendors as $vendorMap) {
               $shippingPrice += (float) $vendorMap;
             }
           }else{
             $shippingPrice =0;
           }

//Mage::log('total shipping:: '.$shippingPrice,Zend_log::INFO,'layout.log',true);
      }//end if
     return $shippingPrice;
    }

    /**
     * Get allowed shipping methods
     *
     * @return array
     */
    public function getAllowedMethods()
    {
            return array('oscpflatshiprate'=>$this->getConfigData('name'));
    }
}
