<?php namespace Shohabbos\Payeer;

use Backend;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            \Shohabbos\Payeer\Components\PayForm::class => 'payFormComponent',
        ];
    }

	public function pluginDetails() {
    	return [
    		'name' => 'shohabbos.payeer::lang.plugin.name',
    		'description' => 'shohabbos.payeer::lang.plugin.description',
    		'author' => 'Shohabbos Olimjonov',
            'icon' => 'oc-icon-paypal',
            'homepage' => 'https://itmaker.uz',
    	];
    }

    public function registerSettings()
    {
	    return [
	    	'transactions' => [
                'label'       => 'shohabbos.payeer::lang.transactions.title',
                'description' => 'shohabbos.payeer::lang.transactions.description',
                'icon'        => 'icon-list-alt',
                'url'         => Backend::url('shohabbos/payeer/transactions'),
                'order'       => 500,
                'category'    => 'shohabbos.payeer::lang.plugin.name',
            ],
	        'settings' => [
	        	'category'    => 'shohabbos.payeer::lang.plugin.name',
	            'label'       => 'shohabbos.payeer::lang.settings.label',
	            'description' => 'shohabbos.payeer::lang.settings.description',
	            'icon'        => 'icon-cog',
	            'class'       => 'Shohabbos\Payeer\Models\Settings',
	            'order'       => 501,
	            'keywords'    => 'payeer paymets',
	        ]
	    ];
    }

}
