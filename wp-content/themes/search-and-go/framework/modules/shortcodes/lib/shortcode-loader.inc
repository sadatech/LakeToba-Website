<?php
namespace SearchAndGoElated\Modules\Shortcodes\Lib;

use SearchAndGoElated\Modules\Shortcodes\Blockquote\Blockquote;
use SearchAndGoElated\Modules\Shortcodes\BlogList\BlogList;
use SearchAndGoElated\Modules\Shortcodes\Button\Button;
use SearchAndGoElated\Modules\Shortcodes\CallToAction\CallToAction;
use SearchAndGoElated\Modules\Shortcodes\Counter\Countdown;
use SearchAndGoElated\Modules\Shortcodes\Counter\Counter;
use SearchAndGoElated\Modules\Shortcodes\CustomFont\CustomFont;
use SearchAndGoElated\Modules\Shortcodes\Dropcaps\Dropcaps;
use SearchAndGoElated\Modules\Shortcodes\ElementsHolder\ElementsHolder;
use SearchAndGoElated\Modules\Shortcodes\ElementsHolderItem\ElementsHolderItem;
use SearchAndGoElated\Modules\Shortcodes\GoogleMap\GoogleMap;
use SearchAndGoElated\Modules\Shortcodes\Highlight\Highlight;
use SearchAndGoElated\Modules\Shortcodes\Icon\Icon;
use SearchAndGoElated\Modules\Shortcodes\IconListItem\IconListItem;
use SearchAndGoElated\Modules\Shortcodes\IconWithText\IconWithText;
use SearchAndGoElated\Modules\Shortcodes\ImageGallery\ImageGallery;
use SearchAndGoElated\Modules\Shortcodes\Message\Message;
use SearchAndGoElated\Modules\Shortcodes\OrderedList\OrderedList;
use SearchAndGoElated\Modules\Shortcodes\PieCharts\PieChartBasic\PieChartBasic;
use SearchAndGoElated\Modules\Shortcodes\PieCharts\PieChartDoughnut\PieChartDoughnut;
use SearchAndGoElated\Modules\Shortcodes\PieCharts\PieChartDoughnut\PieChartPie;
use SearchAndGoElated\Modules\Shortcodes\PieCharts\PieChartWithIcon\PieChartWithIcon;
use SearchAndGoElated\Modules\Shortcodes\PricingTables\PricingTables;
use SearchAndGoElated\Modules\Shortcodes\PricingTable\PricingTable;
use SearchAndGoElated\Modules\Shortcodes\ProgressBar\ProgressBar;
use SearchAndGoElated\Modules\Shortcodes\ElatedUserLogin\ElatedUserLogin;
use SearchAndGoElated\Modules\Shortcodes\ElatedUserRegister\ElatedUserRegister;
use SearchAndGoElated\Modules\Shortcodes\ElatedUserResetPassword\ElatedUserResetPassword;
use SearchAndGoElated\Modules\Shortcodes\Separator\Separator;
use SearchAndGoElated\Modules\Shortcodes\Separator\SeparatorWithIcon;
use SearchAndGoElated\Modules\Shortcodes\SocialShare\SocialShare;
use SearchAndGoElated\Modules\Shortcodes\UnorderedList\UnorderedList;
use SearchAndGoElated\Modules\Shortcodes\VideoButton\VideoButton;
use SearchAndGoElated\Modules\Shortcodes\NumberedSteps\NumberedSteps;

/**
 * Class ShortcodeLoader
 */
class ShortcodeLoader {
	/**
	 * @var private instance of current class
	 */
	private static $instance;
	/**
	 * @var array
	 */
	private $loadedShortcodes = array();

	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {}

	/**
	 * Private sleep because of Singletone
	 */
	private function __wakeup() {}

	/**
	 * Private clone because of Singletone
	 */
	private function __clone() {}

	/**
	 * Returns current instance of class
	 * @return ShortcodeLoader
	 */
	public static function getInstance() {
		if(self::$instance == null) {
			return new self;
		}

		return self::$instance;
	}

	/**
	 * Adds new shortcode. Object that it takes must implement ShortcodeInterface
	 * @param ShortcodeInterface $shortcode
	 */
	private function addShortcode(ShortcodeInterface $shortcode) {
		if(!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
			$this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
		}
	}

	/**
	 * Adds all shortcodes.
	 *
	 * @see ShortcodeLoader::addShortcode()
	 */
	private function addShortcodes() {
		$this->addShortcode(new Blockquote());
		$this->addShortcode(new BlogList());
		$this->addShortcode(new Button());
		$this->addShortcode(new CallToAction());
		$this->addShortcode(new Counter());
		$this->addShortcode(new Countdown());
		$this->addShortcode(new CustomFont());
		$this->addShortcode(new Dropcaps());
		$this->addShortcode(new ElementsHolder());
		$this->addShortcode(new ElementsHolderItem());
		$this->addShortcode(new GoogleMap());
		$this->addShortcode(new Highlight());
		$this->addShortcode(new Icon());
		$this->addShortcode(new IconListItem());
		$this->addShortcode(new IconWithText());
		$this->addShortcode(new ImageGallery());
		$this->addShortcode(new Message());
		$this->addShortcode(new OrderedList());
		$this->addShortcode(new PieChartBasic());
		$this->addShortcode(new PieChartPie());
		$this->addShortcode(new PieChartDoughnut());
		$this->addShortcode(new PieChartWithIcon());
		$this->addShortcode(new PricingTables());
		$this->addShortcode(new PricingTable());
		$this->addShortcode(new ProgressBar());
		$this->addShortcode(new Separator());
		$this->addShortcode(new SeparatorWithIcon());
		$this->addShortcode(new SocialShare());
		$this->addShortcode(new UnorderedList());
		$this->addShortcode(new VideoButton());
		$this->addShortcode(new NumberedSteps());
		$this->addShortcode(new ElatedUserLogin());
		$this->addShortcode(new ElatedUserRegister());
		$this->addShortcode(new ElatedUserResetPassword());
	}
	/**
	 * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
	 * of each shortcode object
	 */
	public function load() {
		$this->addShortcodes();

		foreach ($this->loadedShortcodes as $shortcode) {
			add_shortcode($shortcode->getBase(), array($shortcode, 'render'));
		}
	}
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();