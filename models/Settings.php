<?php namespace Shohabbos\Payeer\Models;

use Model;
use Illuminate\Filesystem\Filesystem;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'shohabbos_payeer_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    protected $files;

    public function __construct()
    {
        parent::__construct();
        $this->files = new Filesystem;
    }

	public function afterSave()
	{
        $path = self::get('status_url');
        $template = "<?php Route::any('{$path}', 'Shohabbos\Payeer\Controllers\Payeer@index');";

        $this->files->put(__DIR__ . '/'.'../routes.php', $template);

        // write code
        $code = self::get('code', null);
        if ($code) {
            $this->files->put(__DIR__ . '/'.'../init.php', $code);
        }
        
	}


}