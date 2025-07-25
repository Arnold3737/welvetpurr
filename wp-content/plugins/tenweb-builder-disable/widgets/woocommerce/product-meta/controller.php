<?php
namespace Tenweb_Buider\Widgets\Woocommerce;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Tenweb_Builder\Classes\Woocommerce\Woocommerce;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Product_Meta extends Widget_Base {

	public function get_name() {
		return 'twbb_woocommerce-product-meta';
	}

	public function get_title() {
		return __( 'Product Meta', 'tenweb-builder' );
	}

	public function get_icon() {
		return 'twbb-product_meta twbb-widget-icon';
	}

	public function get_categories() {
    	return [ Woocommerce::WOOCOMMERCE_BUILDER_GROUP ];
  	}

	public function get_keywords() {
		return [ 'woocommerce', 'shop', 'store', 'meta', 'data', 'product' ];
	}

	protected function register_controls() {
		if ( !Woocommerce::get_preview_product() ) {
	      $this->start_controls_section('general', [
	        'label' => $this->get_title(),
	      ]);
	      $this->add_control('msg', [
	        'type' => \Elementor\Controls_Manager::RAW_HTML,
	        'raw' => Woocommerce::add_new_product_link(),
	      ]);
	      $this->end_controls_section();
	    }
    	else {
			$this->start_controls_section(
				'section_product_meta_style',
				[
					'label' => __( 'Style', 'tenweb-builder' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'wc_style_warning',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => __( 'The style of this widget is often affected by your theme and plugins. If you experience any such issue, try to switch to a basic theme and deactivate related plugins.', 'tenweb-builder' ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);

			$this->add_control(
				'view',
				[
					'label' => __( 'View', 'tenweb-builder' ),
					'type' => Controls_Manager::SELECT,
					'label_block' => false,
					'default' => 'inline',
					'options' => [
						'table' => __( 'Table', 'tenweb-builder' ),
						'stacked' => __( 'Stacked', 'tenweb-builder' ),
						'inline' => __( 'Inline', 'tenweb-builder' ),
					],
					'prefix_class' => 'elementor-woo-meta--view-',
				]
			);

			$this->add_responsive_control(
				'space_between',
				[
					'label' => __( 'Space Between', 'tenweb-builder' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors' => [
						'{{WRAPPER}}:not(.elementor-woo-meta--view-inline) .product_meta .detail-container:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
						'{{WRAPPER}}:not(.elementor-woo-meta--view-inline) .product_meta .detail-container:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
						'{{WRAPPER}}.elementor-woo-meta--view-inline .product_meta .detail-container' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2)',
						'{{WRAPPER}}.elementor-woo-meta--view-inline .product_meta' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2)',
						'body:not(.rtl) {{WRAPPER}}.elementor-woo-meta--view-inline .detail-container:after' => 'right: calc( (-{{SIZE}}{{UNIT}}/2) + (-{{divider_weight.SIZE}}px/2) )',
						'body:not.rtl {{WRAPPER}}.elementor-woo-meta--view-inline .detail-container:after' => 'left: calc( (-{{SIZE}}{{UNIT}}/2) - ({{divider_weight.SIZE}}px/2) )',
					],
				]
			);

      //10web customization
			$this->add_control(
				'hide_sku',
				[
					'label' => __( 'Hide SKU', 'tenweb-builder' ),
					'type' => Controls_Manager::SWITCHER,
					'label_off' => __( 'Off', 'tenweb-builder' ),
					'label_on' => __( 'On', 'tenweb-builder' ),
					'separator' => 'before',
					'default' => 'on',
				]
			);
      //End 10web customization

			$this->add_control(
				'divider',
				[
					'label' => __( 'Divider', 'tenweb-builder' ),
					'type' => Controls_Manager::SWITCHER,
					'label_off' => __( 'Off', 'tenweb-builder' ),
					'label_on' => __( 'On', 'tenweb-builder' ),
					'selectors' => [
						'{{WRAPPER}} .product_meta .detail-container:not(:last-child):after' => 'content: ""',
					],
					'return_value' => 'yes',
					'separator' => 'before',
				]
			);

			$this->add_control(
				'divider_style',
				[
					'label' => __( 'Style', 'tenweb-builder' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'solid' => __( 'Solid', 'tenweb-builder' ),
						'double' => __( 'Double', 'tenweb-builder' ),
						'dotted' => __( 'Dotted', 'tenweb-builder' ),
						'dashed' => __( 'Dashed', 'tenweb-builder' ),
					],
					'default' => 'solid',
					'condition' => [
						'divider' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}}:not(.elementor-woo-meta--view-inline) .product_meta .detail-container:not(:last-child):after' => 'border-top-style: {{VALUE}}',
						'{{WRAPPER}}.elementor-woo-meta--view-inline .product_meta .detail-container:not(:last-child):after' => 'border-left-style: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'divider_weight',
				[
					'label' => __( 'Weight', 'tenweb-builder' ),
					'type' => Controls_Manager::SLIDER,
					'default' => [
						'size' => 1,
					],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 20,
						],
					],
					'condition' => [
						'divider' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}}:not(.elementor-woo-meta--view-inline) .product_meta .detail-container:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}; margin-bottom: calc(-{{SIZE}}{{UNIT}}/2)',
						'{{WRAPPER}}.elementor-woo-meta--view-inline .product_meta .detail-container:not(:last-child):after' => 'border-left-width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'divider_width',
				[
					'label' => __( 'Width', 'tenweb-builder' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ '%', 'px' ],
					'default' => [
						'unit' => '%',
					],
					'condition' => [
						'divider' => 'yes',
						'view!' => 'inline',
					],
					'selectors' => [
						'{{WRAPPER}} .product_meta .detail-container:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'divider_height',
				[
					'label' => __( 'Height', 'tenweb-builder' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ '%', 'px' ],
					'default' => [
						'unit' => '%',
					],
					'range' => [
						'px' => [
							'min' => 1,
							'max' => 100,
						],
						'%' => [
							'min' => 1,
							'max' => 100,
						],
					],
					'condition' => [
						'divider' => 'yes',
						'view' => 'inline',
					],
					'selectors' => [
						'{{WRAPPER}} .product_meta .detail-container:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_control(
				'divider_color',
				[
					'label' => __( 'Color', 'tenweb-builder' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#ddd',
                    'global' => [
                        'default' => Global_Colors::COLOR_TEXT,
                    ],
					'condition' => [
						'divider' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .product_meta .detail-container:not(:last-child):after' => 'border-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'heading_text_style',
				[
					'label' => __( 'Text', 'tenweb-builder' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'text_typography',
					'selector' => '{{WRAPPER}}',
				]
			);

			$this->add_control(
				'text_color',
				[
					'label' => __( 'Color', 'tenweb-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}}' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'heading_link_style',
				[
					'label' => __( 'Link', 'tenweb-builder' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'link_typography',
					'selector' => '{{WRAPPER}} a',
				]
			);

			$this->add_control(
				'link_color',
				[
					'label' => __( 'Color', 'tenweb-builder' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} a' => 'color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_product_meta_captions',
				[
					'label' => __( 'Captions', 'tenweb-builder' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'heading_category_caption',
				[
					'label' => __( 'Category', 'tenweb-builder' ),
					'type' => Controls_Manager::HEADING,
				]
			);

			$this->add_control(
				'category_caption_single',
				[
					'label' => __( 'Singular', 'tenweb-builder' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'Category', 'tenweb-builder' ),
				]
			);

			$this->add_control(
				'category_caption_plural',
				[
					'label' => __( 'Plural', 'tenweb-builder' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'Categories', 'tenweb-builder' ),
				]
			);

			$this->add_control(
				'heading_tag_caption',
				[
					'label' => __( 'Tag', 'tenweb-builder' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'tag_caption_single',
				[
					'label' => __( 'Singular', 'tenweb-builder' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'Tag', 'tenweb-builder' ),
				]
			);

			$this->add_control(
				'tag_caption_plural',
				[
					'label' => __( 'Plural', 'tenweb-builder' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'Tags', 'tenweb-builder' ),
				]
			);

			$this->add_control(
				'heading_sku_caption',
				[
					'label' => __( 'SKU', 'tenweb-builder' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'sku_caption',
				[
					'label' => __( 'SKU', 'tenweb-builder' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'SKU', 'tenweb-builder' ),
				]
			);

			$this->add_control(
				'sku_missing_caption',
				[
					'label' => __( 'Missing', 'tenweb-builder' ),
					'type' => Controls_Manager::TEXT,
					'placeholder' => __( 'N/A', 'tenweb-builder' ),
				]
			);

			$this->end_controls_section();
		}
	}

	private function get_plural_or_single( $single, $plural, $count ) {
		return 1 === $count ? $single : $plural;
	}

	

	protected function render() {

		global $product;
		$meta = '';
		if ( Woocommerce::is_template_page() && Woocommerce::get_preview_product() ) {
	    	$meta = __('This is the product Meta Widget. It is a dynamic widget that displays the Meta of WooCommerce products.', 'tenweb-builder');
		    $product = Woocommerce::get_preview_product();
		}
	    else {
			$product = wc_get_product();
		}
		if ( empty( $product ) ) {
			return;
		}

		$sku = $product->get_sku();

		$settings = $this->get_settings_for_display();

	  //10web customization
		if ( !$sku && !count( $product->get_category_ids() ) && !count( $product->get_tag_ids() ) ) {
			echo esc_html($meta);
			return;
		}

		$sku_caption = ! empty( $settings['sku_caption'] ) ? $settings['sku_caption'] : __( 'SKU', 'tenweb-builder' );
		$sku_missing = ! empty( $settings['sku_missing_caption'] ) ? $settings['sku_missing_caption'] : __( 'N/A', 'tenweb-builder' );
		$category_caption_single = ! empty( $settings['category_caption_single'] ) ? $settings['category_caption_single'] : __( 'Category', 'tenweb-builder' );
		$category_caption_plural = ! empty( $settings['category_caption_plural'] ) ? $settings['category_caption_plural'] : __( 'Categories', 'tenweb-builder' );
		$tag_caption_single = ! empty( $settings['tag_caption_single'] ) ? $settings['tag_caption_single'] : __( 'Tag', 'tenweb-builder' );
		$tag_caption_plural = ! empty( $settings['tag_caption_plural'] ) ? $settings['tag_caption_plural'] : __( 'Tags', 'tenweb-builder' );
		?>
		<div class="product_meta">

			<?php do_action( 'woocommerce_product_meta_start' ); ?>

			<?php if ( '' === $settings['hide_sku'] && wc_product_sku_enabled() && ( $sku || $product->is_type( 'variable' ) ) ) : ?>
				<span class="sku_wrapper detail-container"><span class="detail-label"><?php echo esc_html( $sku_caption ); ?></span> <span class="sku"><?php echo $sku ? esc_html($sku) : esc_html( $sku_missing ); ?></span></span>
			<?php endif; ?>

			<?php if ( count( $product->get_category_ids() ) ) : ?>
				<span class="posted_in detail-container"><span class="detail-label"><?php echo esc_html( $this->get_plural_or_single( $category_caption_single, $category_caption_plural, count( $product->get_category_ids() ) ) ); ?></span> <span class="detail-content"><?php echo get_the_term_list( $product->get_id(), 'product_cat', '', ', ' ); ?></span></span>
			<?php endif; ?>

			<?php if ( count( $product->get_tag_ids() ) ) : ?>
				<span class="tagged_as detail-container"><span class="detail-label"><?php echo esc_html( $this->get_plural_or_single( $tag_caption_single, $tag_caption_plural, count( $product->get_tag_ids() ) ) ); ?></span> <span class="detail-content"><?php echo get_the_term_list( $product->get_id(), 'product_tag', '', ', ' ); ?></span></span>
			<?php endif; ?>

			<?php do_action( 'woocommerce_product_meta_end' ); ?>

		</div>
		<?php
	
	}

	public function render_plain_content() {}
}

\Elementor\Plugin::instance()->widgets_manager->register( new Product_Meta() );
