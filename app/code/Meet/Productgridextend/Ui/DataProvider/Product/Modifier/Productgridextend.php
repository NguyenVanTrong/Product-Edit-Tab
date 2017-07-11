<?php
namespace Meet\Productgridextend\Ui\DataProvider\Product\Modifier;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Api\WebsiteRepositoryInterface;
use Magento\Store\Api\GroupRepositoryInterface;
use Magento\Store\Api\StoreRepositoryInterface;
use Magento\Ui\Component\Form;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;

class Productgridextend extends AbstractModifier
{
    const SORT_ORDER = 40;

    protected $locator;

    protected $websiteRepository;

    protected $groupRepository;

    protected $storeRepository;

    protected $websitesOptionsList;

    protected $storeManager;

    protected $websitesList;

    private $dataScopeName;

    public function __construct(
        LocatorInterface $locator,
        StoreManagerInterface $storeManager,
        WebsiteRepositoryInterface $websiteRepository,
        GroupRepositoryInterface $groupRepository,
        StoreRepositoryInterface $storeRepository,
        $dataScopeName
    ) {
        $this->locator = $locator;
        $this->storeManager = $storeManager;
        $this->websiteRepository = $websiteRepository;
        $this->groupRepository = $groupRepository;
        $this->storeRepository = $storeRepository;
        $this->dataScopeName = $dataScopeName;
    }

    public function modifyData(array $data)
    {
        return $data;
    }

    public function modifyMeta(array $meta)
    {
        if (!$this->storeManager->isSingleStoreMode()) {
            $meta = array_replace_recursive(
                $meta,
                [
                    'productgridextend' => [
                        'arguments' => [
                            'data' => [
                                'config' => [
                                    'additionalClasses' => 'admin__fieldset-product-productgridextend',
                                    'label' => __('Price Per Customer'),
                                    'collapsible' => true,
                                    'componentType' => Form\Fieldset::NAME,
                                    'sortOrder' => $this->getNextGroupSortOrder(
                                        $meta,
                                        'search-engine-optimization',
                                        self::SORT_ORDER
                                    ),
                                ],
                            ],
                        ],
                        'children' => $this->getPanelChildren(),
                    ],
                ]
            );
        }

        return $meta;
    }

    protected function getPanelChildren()
    {
        return [
            'productgridextend_products_button_set' => $this->getButtonSet()

        ];
    }

    protected function getButtonSet()
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'content' => "test",
                        'formElement' => 'container',
                        'componentType' => 'container',
                        'content1' => __(
                            'Apply discount for this product to customers.'
                        ),
                        'label' => false,
                        'template' => 'ui/form/components/complex',
                    ],
                ],
            ],
            'children' => [

                'create_productgridextend_products_button' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'formElement' => 'container',
                                'componentType' => 'container',
                                 'component' => 'Magento_Ui/js/form/components/button',
                                'actions' => [
                                    [
                                        'targetName' => $this->dataScopeName.'.configurableModal',
                                        'actionName' => 'trigger',
                                        'params' => ['active', true],
                                    ],
                                    [
                                        'targetName' => $this->dataScopeName.'.configurableModal',
                                        'actionName' => 'openModal',
                                    ],
                                ],
                                'title' => __('Price Per Customer Configuration'),
                                'sortOrder' => 20,

                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}