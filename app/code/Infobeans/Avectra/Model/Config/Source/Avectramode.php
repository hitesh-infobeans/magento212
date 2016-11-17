<?php
 
namespace Infobeans\Avectra\Model\Config\Source;
 
class AvectraMode implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
 
        return [
            ['value' => 0, 'label' => __('Development')],
            ['value' => 1, 'label' => __('Production')], 
        ];
    }
}