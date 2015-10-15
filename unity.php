<?php

class UnityTwigView implements Unity\View\Template {
	private $loader;
	private $twig;

	public function __construct($path) {
		$this->loader = new Twig_Loader_Filesystem(config()->view());
		$this->loader->addPath(config()->view() . '../theme/', 'theme');
		$this->twig = new Twig_Environment($this->loader, array(
			'autoescape' => false,
			'cache' => false // config()->storage() . '/views',
		));

		$this->twig->addFunction(new \Twig_SimpleFunction('url', 'url'));
		$this->twig->addFunction(new \Twig_SimpleFunction('config', 'config'));
	}

	public function render($name, $params = []) {
		return $this->twig->render($name, $params);
	}
}

return function() {
	module()->view('UnityTwigView');
};