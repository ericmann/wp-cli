<?php

WP_CLI::add_command( 'generate-plugin', new GeneratePlugin_Command );

/**
 * Automatically generate a plugin, its core files, and a directory structure based
 * on define settings.
 *
 * @package wp-cli
 * @subpackage commands/internals
 */
class GeneratePlugin_Command extends WP_CLI_Command {

	/**
	 * Generates a new plugin directory and supporting files and stucture.
	 *
	 * @synopsis [--name='Plugin Stub'] [--slug='plugin-stub'] [--lprefix='pluginstub'] [--uprefix='PLUGINSTUB'] [--cprefix='PluginStub'] [--author='Plugin Author'] [--license='GPLv2+']
	 *
	 * @param $args
	 * @param $assoc_args
	 */
	public function __invoke( $_, $assoc_args ) {
		$defaults = array(
			'name'    => 'Plugin Stub',
			'slug'    => 'not-set',
			'lprefix' => 'not-set',
			'uprefix' => 'not-set',
			'cprefix' => 'not-set',
			'author'  => 'Plugin Author',
			'license' => 'GPLv2+'
		);

		$args = wp_parse_args( $assoc_args, $defaults );

		if ( 'not-set' == $args['slug'] ) {
			$args['slug'] = sanitize_title( $args['name'] );
		}

		if ( 'not-set' == $args['cprefix'] ) {
			$args['cprefix'] = str_replace( ' ', '', $args['name'] );
		}

		if ( 'not-set' == $args['lprefix'] ) {
			$args['lprefix'] = strtolower( $args['cprefix'] );
		}

		if ( 'not-set' == $args['uprefix'] ) {
			$args['uprefix'] = strtoupper( $args['cprefix'] );
		}
	}
}
