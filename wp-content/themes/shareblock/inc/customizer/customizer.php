<?php
if ( ! class_exists( 'shareblock_customizer_default' ) ) {
	final class shareblock_customizer_default {
		private static $instance = null;
		private $wp_customize;
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		private function __construct() {
			add_action( 'customize_controls_print_scripts', array( $this, 'shareblock_customize_controls_print_scripts' ) );
			add_action( 'wp_ajax_customizer_reset', array( $this, 'shareblock_ajax_customizer_reset' ) );
			add_action( 'customize_register', array( $this, 'shareblock_customize_register' ) );
		}
		
		public function shareblock_customize_controls_print_scripts() {
			wp_enqueue_style( 'css-for-customize', get_template_directory_uri() . '/inc/customizer/css/customizer-control.css' );
			wp_enqueue_script( 'js-for-customize', get_template_directory_uri() . '/inc/customizer/js/customizer-control.js', array( 'jquery', 'customize-controls' ) );
			wp_localize_script( 'js-for-customize', 'shareblock_customizer_reset', array(
				'reset'   => esc_html__( 'Reset', 'shareblock' ),
				'confirm' => esc_html__( "Clicking the Reset button will revert all settings in the customizer except for menus, widgets and site identity.", 'shareblock' ),
				'nonce'   => array(
					'reset' => wp_create_nonce( 'customizer-reset' ),
				)
			) );
		}
		public function shareblock_customize_register( $wp_customize ) {
			$this->wp_customize = $wp_customize;
		}

		public function shareblock_ajax_customizer_reset() {
			if ( ! $this->wp_customize->is_preview() ) {
				wp_send_json_error( 'not_preview' );
			}
			if ( ! check_ajax_referer( 'customizer-reset', 'nonce', false ) ) {
				wp_send_json_error( 'invalid_nonce' );
			}
			$this->shareblock_reset_customizer();
			wp_send_json_success();
		}
		public function shareblock_reset_customizer() {
			$settings = $this->wp_customize->settings();
			foreach ( $settings as $setting ) {
				if ( 'theme_mod' == $setting->type ) {
					remove_theme_mod( $setting->id );
				}
			}
		}
	}
}
shareblock_customizer_default::get_instance();

function shareblock_register_theme_customizer( $wp_customize ) {
	class shareblock_control_image_select extends WP_Customize_Control {
	    public function render_content(){
	        if ( empty( $this->choices ) ){ return; }
	        if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif;
				if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html($this->description) ; ?></span>
			<?php endif;
	        $html = array();
			$tpl  = '<label class="jlc-image-select"><img src="%s"><input type="%s" class="hidden" name="%s" value="%s" %s%s></label>';
			$field = $this->input_attrs;
			foreach ( $this->choices as $value => $image )
			{
				$html[] = sprintf(
					$tpl,
					$image,
					$field['multiple'] ? 'checkbox' : 'radio',
					$this->id,
					esc_attr( $value ),
					$this->get_link(),
					checked( $this->value(), $value, false )
				);
			}
			echo implode(' ', $html); 
	    }
	}
	// Header text
	class shareblock_Customize_Control_Title extends WP_Customize_Control {
	    public function render_content(){
	        if ( empty( $this->label ) ){ return; }
	        if ( ! empty( $this->label ) ) : ?>
					<h2 class="jlc_headding"><?php echo esc_html( $this->label ); ?>
				<?php endif;
				if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html($this->description) ; ?></span>
			</h2><?php endif; 
	    }
	}
	
	$option_sidebar = array();
	$sidebars = get_option('sbg_sidebars');
	$option_sidebar['default']= esc_html__( 'Default Sidebar', 'shareblock' );
	if(isset($sidebars)) {
		if(is_array($sidebars)) {
			foreach($sidebars as $sidebar) {
				$sidebar_lower = strtolower($sidebar);
				$sidebarid = str_replace(' ','-', $sidebar_lower);
				$option_sidebar[$sidebarid] = $sidebar;
			}			
		}
	}
	
	// Custom fonts	
	$jl_custom_font = array();
	if(function_exists('shareblock_bac_PostViews')){
		$fonts = shareblock_font_tax::shareblock_get_fonts();
		if ( empty ($fonts)) {
			$jl_custom_font = array();	
		}else{
			foreach ( $fonts as $font => $values ) {
				$jl_custom_font['jl_c_'.$font] = 'Custom font - '.$font;
			}
		}
	}else{
		$jl_custom_font = array();
	}	
	// Font and Google Font	
	$jl_google_font = array(	
	'ABeeZee' => 'ABeeZee',
	'Abel' => 'Abel',
	'Abhaya Libre' => 'Abhaya Libre',
	'Abril Fatface' => 'Abril Fatface',
	'Aclonica' => 'Aclonica',
	'Acme' => 'Acme',
	'Actor' => 'Actor',
	'Adamina' => 'Adamina',
	'Advent Pro' => 'Advent Pro',
	'Aguafina Script' => 'Aguafina Script',
	'Akaya Kanadaka' => 'Akaya Kanadaka',
	'Akaya Telivigala' => 'Akaya Telivigala',
	'Akronim' => 'Akronim',
	'Aladin' => 'Aladin',
	'Alata' => 'Alata',
	'Alatsi' => 'Alatsi',
	'Aldrich' => 'Aldrich',
	'Alef' => 'Alef',
	'Alegreya' => 'Alegreya',
	'Alegreya SC' => 'Alegreya SC',
	'Alegreya Sans' => 'Alegreya Sans',
	'Alegreya Sans SC' => 'Alegreya Sans SC',
	'Aleo' => 'Aleo',
	'Alex Brush' => 'Alex Brush',
	'Alfa Slab One' => 'Alfa Slab One',
	'Alice' => 'Alice',
	'Alike' => 'Alike',
	'Alike Angular' => 'Alike Angular',
	'Allan' => 'Allan',
	'Allerta' => 'Allerta',
	'Allerta Stencil' => 'Allerta Stencil',
	'Allison' => 'Allison',
	'Allura' => 'Allura',
	'Almarai' => 'Almarai',
	'Almendra' => 'Almendra',
	'Almendra Display' => 'Almendra Display',
	'Almendra SC' => 'Almendra SC',
	'Alumni Sans' => 'Alumni Sans',
	'Amarante' => 'Amarante',
	'Amaranth' => 'Amaranth',
	'Amatic SC' => 'Amatic SC',
	'Amethysta' => 'Amethysta',
	'Amiko' => 'Amiko',
	'Amiri' => 'Amiri',
	'Amita' => 'Amita',
	'Anaheim' => 'Anaheim',
	'Andada Pro' => 'Andada Pro',
	'Andika' => 'Andika',
	'Andika New Basic' => 'Andika New Basic',
	'Angkor' => 'Angkor',
	'Annie Use Your Telescope' => 'Annie Use Your Telescope',
	'Anonymous Pro' => 'Anonymous Pro',
	'Antic' => 'Antic',
	'Antic Didone' => 'Antic Didone',
	'Antic Slab' => 'Antic Slab',
	'Anton' => 'Anton',
	'Antonio' => 'Antonio',
	'Arapey' => 'Arapey',
	'Arbutus' => 'Arbutus',
	'Arbutus Slab' => 'Arbutus Slab',
	'Architects Daughter' => 'Architects Daughter',
	'Archivo' => 'Archivo',
	'Archivo Black' => 'Archivo Black',
	'Archivo Narrow' => 'Archivo Narrow',
	'Are You Serious' => 'Are You Serious',
	'Aref Ruqaa' => 'Aref Ruqaa',
	'Arima Madurai' => 'Arima Madurai',
	'Arimo' => 'Arimo',
	'Arizonia' => 'Arizonia',
	'Armata' => 'Armata',
	'Arsenal' => 'Arsenal',
	'Artifika' => 'Artifika',
	'Arvo' => 'Arvo',
	'Arya' => 'Arya',
	'Asap' => 'Asap',
	'Asap Condensed' => 'Asap Condensed',
	'Asar' => 'Asar',
	'Asset' => 'Asset',
	'Assistant' => 'Assistant',
	'Astloch' => 'Astloch',
	'Asul' => 'Asul',
	'Athiti' => 'Athiti',
	'Atkinson Hyperlegible' => 'Atkinson Hyperlegible',
	'Atma' => 'Atma',
	'Atomic Age' => 'Atomic Age',
	'Aubrey' => 'Aubrey',
	'Audiowide' => 'Audiowide',
	'Autour One' => 'Autour One',
	'Average' => 'Average',
	'Average Sans' => 'Average Sans',
	'Averia Gruesa Libre' => 'Averia Gruesa Libre',
	'Averia Libre' => 'Averia Libre',
	'Averia Sans Libre' => 'Averia Sans Libre',
	'Averia Serif Libre' => 'Averia Serif Libre',
	'Azeret Mono' => 'Azeret Mono',
	'B612' => 'B612',
	'B612 Mono' => 'B612 Mono',
	'Bad Script' => 'Bad Script',
	'Bahiana' => 'Bahiana',
	'Bahianita' => 'Bahianita',
	'Bai Jamjuree' => 'Bai Jamjuree',
	'Ballet' => 'Ballet',
	'Baloo 2' => 'Baloo 2',
	'Baloo Bhai 2' => 'Baloo Bhai 2',
	'Baloo Bhaina 2' => 'Baloo Bhaina 2',
	'Baloo Chettan 2' => 'Baloo Chettan 2',
	'Baloo Da 2' => 'Baloo Da 2',
	'Baloo Paaji 2' => 'Baloo Paaji 2',
	'Baloo Tamma 2' => 'Baloo Tamma 2',
	'Baloo Tammudu 2' => 'Baloo Tammudu 2',
	'Baloo Thambi 2' => 'Baloo Thambi 2',
	'Balsamiq Sans' => 'Balsamiq Sans',
	'Balthazar' => 'Balthazar',
	'Bangers' => 'Bangers',
	'Barlow' => 'Barlow',
	'Barlow Condensed' => 'Barlow Condensed',
	'Barlow Semi Condensed' => 'Barlow Semi Condensed',
	'Barriecito' => 'Barriecito',
	'Barrio' => 'Barrio',
	'Basic' => 'Basic',
	'Baskervville' => 'Baskervville',
	'Battambang' => 'Battambang',
	'Baumans' => 'Baumans',
	'Bayon' => 'Bayon',
	'Be Vietnam' => 'Be Vietnam',
	'Be Vietnam Pro' => 'Be Vietnam Pro',
	'Bebas Neue' => 'Bebas Neue',
	'Belgrano' => 'Belgrano',
	'Bellefair' => 'Bellefair',
	'Belleza' => 'Belleza',
	'Bellota' => 'Bellota',
	'Bellota Text' => 'Bellota Text',
	'BenchNine' => 'BenchNine',
	'Benne' => 'Benne',
	'Bentham' => 'Bentham',
	'Berkshire Swash' => 'Berkshire Swash',
	'Besley' => 'Besley',
	'Beth Ellen' => 'Beth Ellen',
	'Bevan' => 'Bevan',
	'Big Shoulders Display' => 'Big Shoulders Display',
	'Big Shoulders Inline Display' => 'Big Shoulders Inline Display',
	'Big Shoulders Inline Text' => 'Big Shoulders Inline Text',
	'Big Shoulders Stencil Display' => 'Big Shoulders Stencil Display',
	'Big Shoulders Stencil Text' => 'Big Shoulders Stencil Text',
	'Big Shoulders Text' => 'Big Shoulders Text',
	'Bigelow Rules' => 'Bigelow Rules',
	'Bigshot One' => 'Bigshot One',
	'Bilbo' => 'Bilbo',
	'Bilbo Swash Caps' => 'Bilbo Swash Caps',
	'BioRhyme' => 'BioRhyme',
	'BioRhyme Expanded' => 'BioRhyme Expanded',
	'Birthstone' => 'Birthstone',
	'Birthstone Bounce' => 'Birthstone Bounce',
	'Biryani' => 'Biryani',
	'Bitter' => 'Bitter',
	'Black And White Picture' => 'Black And White Picture',
	'Black Han Sans' => 'Black Han Sans',
	'Black Ops One' => 'Black Ops One',
	'Blinker' => 'Blinker',
	'Bodoni Moda' => 'Bodoni Moda',
	'Bokor' => 'Bokor',
	'Bona Nova' => 'Bona Nova',
	'Bonbon' => 'Bonbon',
	'Bonheur Royale' => 'Bonheur Royale',
	'Boogaloo' => 'Boogaloo',
	'Bowlby One' => 'Bowlby One',
	'Bowlby One SC' => 'Bowlby One SC',
	'Brawler' => 'Brawler',
	'Bree Serif' => 'Bree Serif',
	'Brygada 1918' => 'Brygada 1918',
	'Bubblegum Sans' => 'Bubblegum Sans',
	'Bubbler One' => 'Bubbler One',
	'Buda' => 'Buda',
	'Buenard' => 'Buenard',
	'Bungee' => 'Bungee',
	'Bungee Hairline' => 'Bungee Hairline',
	'Bungee Inline' => 'Bungee Inline',
	'Bungee Outline' => 'Bungee Outline',
	'Bungee Shade' => 'Bungee Shade',
	'Butcherman' => 'Butcherman',
	'Butterfly Kids' => 'Butterfly Kids',
	'Cabin' => 'Cabin',
	'Cabin Condensed' => 'Cabin Condensed',
	'Cabin Sketch' => 'Cabin Sketch',
	'Caesar Dressing' => 'Caesar Dressing',
	'Cagliostro' => 'Cagliostro',
	'Cairo' => 'Cairo',
	'Caladea' => 'Caladea',
	'Calistoga' => 'Calistoga',
	'Calligraffitti' => 'Calligraffitti',
	'Cambay' => 'Cambay',
	'Cambo' => 'Cambo',
	'Candal' => 'Candal',
	'Cantarell' => 'Cantarell',
	'Cantata One' => 'Cantata One',
	'Cantora One' => 'Cantora One',
	'Capriola' => 'Capriola',
	'Caramel' => 'Caramel',
	'Carattere' => 'Carattere',
	'Cardo' => 'Cardo',
	'Carme' => 'Carme',
	'Carrois Gothic' => 'Carrois Gothic',
	'Carrois Gothic SC' => 'Carrois Gothic SC',
	'Carter One' => 'Carter One',
	'Castoro' => 'Castoro',
	'Catamaran' => 'Catamaran',
	'Caudex' => 'Caudex',
	'Caveat' => 'Caveat',
	'Caveat Brush' => 'Caveat Brush',
	'Cedarville Cursive' => 'Cedarville Cursive',
	'Ceviche One' => 'Ceviche One',
	'Chakra Petch' => 'Chakra Petch',
	'Changa' => 'Changa',
	'Changa One' => 'Changa One',
	'Chango' => 'Chango',
	'Charm' => 'Charm',
	'Charmonman' => 'Charmonman',
	'Chathura' => 'Chathura',
	'Chau Philomene One' => 'Chau Philomene One',
	'Chela One' => 'Chela One',
	'Chelsea Market' => 'Chelsea Market',
	'Chenla' => 'Chenla',
	'Cherish' => 'Cherish',
	'Cherry Cream Soda' => 'Cherry Cream Soda',
	'Cherry Swash' => 'Cherry Swash',
	'Chewy' => 'Chewy',
	'Chicle' => 'Chicle',
	'Chilanka' => 'Chilanka',
	'Chivo' => 'Chivo',
	'Chonburi' => 'Chonburi',
	'Cinzel' => 'Cinzel',
	'Cinzel Decorative' => 'Cinzel Decorative',
	'Clicker Script' => 'Clicker Script',
	'Coda' => 'Coda',
	'Coda Caption' => 'Coda Caption',
	'Codystar' => 'Codystar',
	'Coiny' => 'Coiny',
	'Combo' => 'Combo',
	'Comfortaa' => 'Comfortaa',
	'Comic Neue' => 'Comic Neue',
	'Coming Soon' => 'Coming Soon',
	'Commissioner' => 'Commissioner',
	'Concert One' => 'Concert One',
	'Condiment' => 'Condiment',
	'Content' => 'Content',
	'Contrail One' => 'Contrail One',
	'Convergence' => 'Convergence',
	'Cookie' => 'Cookie',
	'Copse' => 'Copse',
	'Corben' => 'Corben',
	'Cormorant' => 'Cormorant',
	'Cormorant Garamond' => 'Cormorant Garamond',
	'Cormorant Infant' => 'Cormorant Infant',
	'Cormorant SC' => 'Cormorant SC',
	'Cormorant Unicase' => 'Cormorant Unicase',
	'Cormorant Upright' => 'Cormorant Upright',
	'Courgette' => 'Courgette',
	'Courier Prime' => 'Courier Prime',
	'Cousine' => 'Cousine',
	'Coustard' => 'Coustard',
	'Covered By Your Grace' => 'Covered By Your Grace',
	'Crafty Girls' => 'Crafty Girls',
	'Creepster' => 'Creepster',
	'Crete Round' => 'Crete Round',
	'Crimson Pro' => 'Crimson Pro',
	'Crimson Text' => 'Crimson Text',
	'Croissant One' => 'Croissant One',
	'Crushed' => 'Crushed',
	'Cuprum' => 'Cuprum',
	'Cute Font' => 'Cute Font',
	'Cutive' => 'Cutive',
	'Cutive Mono' => 'Cutive Mono',
	'DM Mono' => 'DM Mono',
	'DM Sans' => 'DM Sans',
	'DM Serif Display' => 'DM Serif Display',
	'DM Serif Text' => 'DM Serif Text',
	'Damion' => 'Damion',
	'Dancing Script' => 'Dancing Script',
	'Dangrek' => 'Dangrek',
	'Darker Grotesque' => 'Darker Grotesque',
	'David Libre' => 'David Libre',
	'Dawning of a New Day' => 'Dawning of a New Day',
	'Days One' => 'Days One',
	'Dekko' => 'Dekko',
	'Dela Gothic One' => 'Dela Gothic One',
	'Delius' => 'Delius',
	'Delius Swash Caps' => 'Delius Swash Caps',
	'Delius Unicase' => 'Delius Unicase',
	'Della Respira' => 'Della Respira',
	'Denk One' => 'Denk One',
	'Devonshire' => 'Devonshire',
	'Dhurjati' => 'Dhurjati',
	'Didact Gothic' => 'Didact Gothic',
	'Diplomata' => 'Diplomata',
	'Diplomata SC' => 'Diplomata SC',
	'Do Hyeon' => 'Do Hyeon',
	'Dokdo' => 'Dokdo',
	'Domine' => 'Domine',
	'Donegal One' => 'Donegal One',
	'Doppio One' => 'Doppio One',
	'Dorsa' => 'Dorsa',
	'Dosis' => 'Dosis',
	'DotGothic16' => 'DotGothic16',
	'Dr Sugiyama' => 'Dr Sugiyama',
	'Duru Sans' => 'Duru Sans',
	'Dynalight' => 'Dynalight',
	'EB Garamond' => 'EB Garamond',
	'Eagle Lake' => 'Eagle Lake',
	'East Sea Dokdo' => 'East Sea Dokdo',
	'Eater' => 'Eater',
	'Economica' => 'Economica',
	'Eczar' => 'Eczar',
	'El Messiri' => 'El Messiri',
	'Electrolize' => 'Electrolize',
	'Elsie' => 'Elsie',
	'Elsie Swash Caps' => 'Elsie Swash Caps',
	'Emblema One' => 'Emblema One',
	'Emilys Candy' => 'Emilys Candy',
	'Encode Sans' => 'Encode Sans',
	'Encode Sans Condensed' => 'Encode Sans Condensed',
	'Encode Sans Expanded' => 'Encode Sans Expanded',
	'Encode Sans SC' => 'Encode Sans SC',
	'Encode Sans Semi Condensed' => 'Encode Sans Semi Condensed',
	'Encode Sans Semi Expanded' => 'Encode Sans Semi Expanded',
	'Engagement' => 'Engagement',
	'Englebert' => 'Englebert',
	'Enriqueta' => 'Enriqueta',
	'Ephesis' => 'Ephesis',
	'Epilogue' => 'Epilogue',
	'Erica One' => 'Erica One',
	'Esteban' => 'Esteban',
	'Euphoria Script' => 'Euphoria Script',
	'Ewert' => 'Ewert',
	'Exo' => 'Exo',
	'Exo 2' => 'Exo 2',
	'Expletus Sans' => 'Expletus Sans',
	'Explora' => 'Explora',
	'Fahkwang' => 'Fahkwang',
	'Fanwood Text' => 'Fanwood Text',
	'Farro' => 'Farro',
	'Farsan' => 'Farsan',
	'Fascinate' => 'Fascinate',
	'Fascinate Inline' => 'Fascinate Inline',
	'Faster One' => 'Faster One',
	'Fasthand' => 'Fasthand',
	'Fauna One' => 'Fauna One',
	'Faustina' => 'Faustina',
	'Federant' => 'Federant',
	'Federo' => 'Federo',
	'Felipa' => 'Felipa',
	'Fenix' => 'Fenix',
	'Festive' => 'Festive',
	'Finger Paint' => 'Finger Paint',
	'Fira Code' => 'Fira Code',
	'Fira Mono' => 'Fira Mono',
	'Fira Sans' => 'Fira Sans',
	'Fira Sans Condensed' => 'Fira Sans Condensed',
	'Fira Sans Extra Condensed' => 'Fira Sans Extra Condensed',
	'Fjalla One' => 'Fjalla One',
	'Fjord One' => 'Fjord One',
	'Flamenco' => 'Flamenco',
	'Flavors' => 'Flavors',
	'Fleur De Leah' => 'Fleur De Leah',
	'Fondamento' => 'Fondamento',
	'Fontdiner Swanky' => 'Fontdiner Swanky',
	'Forum' => 'Forum',
	'Francois One' => 'Francois One',
	'Frank Ruhl Libre' => 'Frank Ruhl Libre',
	'Fraunces' => 'Fraunces',
	'Freckle Face' => 'Freckle Face',
	'Fredericka the Great' => 'Fredericka the Great',
	'Fredoka One' => 'Fredoka One',
	'Freehand' => 'Freehand',
	'Fresca' => 'Fresca',
	'Frijole' => 'Frijole',
	'Fruktur' => 'Fruktur',
	'Fugaz One' => 'Fugaz One',
	'Fuggles' => 'Fuggles',
	'GFS Didot' => 'GFS Didot',
	'GFS Neohellenic' => 'GFS Neohellenic',
	'Gabriela' => 'Gabriela',
	'Gaegu' => 'Gaegu',
	'Gafata' => 'Gafata',
	'Galada' => 'Galada',
	'Galdeano' => 'Galdeano',
	'Galindo' => 'Galindo',
	'Gamja Flower' => 'Gamja Flower',
	'Gayathri' => 'Gayathri',
	'Gelasio' => 'Gelasio',
	'Gemunu Libre' => 'Gemunu Libre',
	'Gentium Basic' => 'Gentium Basic',
	'Gentium Book Basic' => 'Gentium Book Basic',
	'Geo' => 'Geo',
	'Georama' => 'Georama',
	'Geostar' => 'Geostar',
	'Geostar Fill' => 'Geostar Fill',
	'Germania One' => 'Germania One',
	'Gideon Roman' => 'Gideon Roman',
	'Gidugu' => 'Gidugu',
	'Gilda Display' => 'Gilda Display',
	'Girassol' => 'Girassol',
	'Give You Glory' => 'Give You Glory',
	'Glass Antiqua' => 'Glass Antiqua',
	'Glegoo' => 'Glegoo',
	'Gloria Hallelujah' => 'Gloria Hallelujah',
	'Glory' => 'Glory',
	'Gluten' => 'Gluten',
	'Goblin One' => 'Goblin One',
	'Gochi Hand' => 'Gochi Hand',
	'Goldman' => 'Goldman',
	'Gorditas' => 'Gorditas',
	'Gothic A1' => 'Gothic A1',
	'Gotu' => 'Gotu',
	'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
	'Gowun Batang' => 'Gowun Batang',
	'Gowun Dodum' => 'Gowun Dodum',
	'Graduate' => 'Graduate',
	'Grand Hotel' => 'Grand Hotel',
	'Grandstander' => 'Grandstander',
	'Gravitas One' => 'Gravitas One',
	'Great Vibes' => 'Great Vibes',
	'Grechen Fuemen' => 'Grechen Fuemen',
	'Grenze' => 'Grenze',
	'Grenze Gotisch' => 'Grenze Gotisch',
	'Grey Qo' => 'Grey Qo',
	'Griffy' => 'Griffy',
	'Gruppo' => 'Gruppo',
	'Gudea' => 'Gudea',
	'Gugi' => 'Gugi',
	'Gupter' => 'Gupter',
	'Gurajada' => 'Gurajada',
	'Habibi' => 'Habibi',
	'Hachi Maru Pop' => 'Hachi Maru Pop',
	'Hahmlet' => 'Hahmlet',
	'Halant' => 'Halant',
	'Hammersmith One' => 'Hammersmith One',
	'Hanalei' => 'Hanalei',
	'Hanalei Fill' => 'Hanalei Fill',
	'Handlee' => 'Handlee',
	'Hanuman' => 'Hanuman',
	'Happy Monkey' => 'Happy Monkey',
	'Harmattan' => 'Harmattan',
	'Headland One' => 'Headland One',
	'Heebo' => 'Heebo',
	'Henny Penny' => 'Henny Penny',
	'Hepta Slab' => 'Hepta Slab',
	'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
	'Hi Melody' => 'Hi Melody',
	'Hina Mincho' => 'Hina Mincho',
	'Hind' => 'Hind',
	'Hind Guntur' => 'Hind Guntur',
	'Hind Madurai' => 'Hind Madurai',
	'Hind Siliguri' => 'Hind Siliguri',
	'Hind Vadodara' => 'Hind Vadodara',
	'Holtwood One SC' => 'Holtwood One SC',
	'Homemade Apple' => 'Homemade Apple',
	'Homenaje' => 'Homenaje',
	'IBM Plex Mono' => 'IBM Plex Mono',
	'IBM Plex Sans' => 'IBM Plex Sans',
	'IBM Plex Sans Arabic' => 'IBM Plex Sans Arabic',
	'IBM Plex Sans Condensed' => 'IBM Plex Sans Condensed',
	'IBM Plex Sans Devanagari' => 'IBM Plex Sans Devanagari',
	'IBM Plex Sans Hebrew' => 'IBM Plex Sans Hebrew',
	'IBM Plex Sans KR' => 'IBM Plex Sans KR',
	'IBM Plex Sans Thai' => 'IBM Plex Sans Thai',
	'IBM Plex Sans Thai Looped' => 'IBM Plex Sans Thai Looped',
	'IBM Plex Serif' => 'IBM Plex Serif',
	'IM Fell DW Pica' => 'IM Fell DW Pica',
	'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
	'IM Fell Double Pica' => 'IM Fell Double Pica',
	'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
	'IM Fell English' => 'IM Fell English',
	'IM Fell English SC' => 'IM Fell English SC',
	'IM Fell French Canon' => 'IM Fell French Canon',
	'IM Fell French Canon SC' => 'IM Fell French Canon SC',
	'IM Fell Great Primer' => 'IM Fell Great Primer',
	'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
	'Ibarra Real Nova' => 'Ibarra Real Nova',
	'Iceberg' => 'Iceberg',
	'Iceland' => 'Iceland',
	'Imbue' => 'Imbue',
	'Imprima' => 'Imprima',
	'Inconsolata' => 'Inconsolata',
	'Inder' => 'Inder',
	'Indie Flower' => 'Indie Flower',
	'Inika' => 'Inika',
	'Inknut Antiqua' => 'Inknut Antiqua',
	'Inria Sans' => 'Inria Sans',
	'Inria Serif' => 'Inria Serif',
	'Inter' => 'Inter',
	'Irish Grover' => 'Irish Grover',
	'Istok Web' => 'Istok Web',
	'Italiana' => 'Italiana',
	'Italianno' => 'Italianno',
	'Itim' => 'Itim',
	'Jacques Francois' => 'Jacques Francois',
	'Jacques Francois Shadow' => 'Jacques Francois Shadow',
	'Jaldi' => 'Jaldi',
	'JetBrains Mono' => 'JetBrains Mono',
	'Jim Nightshade' => 'Jim Nightshade',
	'Jockey One' => 'Jockey One',
	'Jolly Lodger' => 'Jolly Lodger',
	'Jomhuria' => 'Jomhuria',
	'Jomolhari' => 'Jomolhari',
	'Josefin Sans' => 'Josefin Sans',
	'Josefin Slab' => 'Josefin Slab',
	'Jost' => 'Jost',
	'Joti One' => 'Joti One',
	'Jua' => 'Jua',
	'Judson' => 'Judson',
	'Julee' => 'Julee',
	'Julius Sans One' => 'Julius Sans One',
	'Junge' => 'Junge',
	'Jura' => 'Jura',
	'Just Another Hand' => 'Just Another Hand',
	'Just Me Again Down Here' => 'Just Me Again Down Here',
	'K2D' => 'K2D',
	'Kadwa' => 'Kadwa',
	'Kaisei Decol' => 'Kaisei Decol',
	'Kaisei HarunoUmi' => 'Kaisei HarunoUmi',
	'Kaisei Opti' => 'Kaisei Opti',
	'Kaisei Tokumin' => 'Kaisei Tokumin',
	'Kalam' => 'Kalam',
	'Kameron' => 'Kameron',
	'Kanit' => 'Kanit',
	'Kantumruy' => 'Kantumruy',
	'Karantina' => 'Karantina',
	'Karla' => 'Karla',
	'Karma' => 'Karma',
	'Katibeh' => 'Katibeh',
	'Kaushan Script' => 'Kaushan Script',
	'Kavivanar' => 'Kavivanar',
	'Kavoon' => 'Kavoon',
	'Kdam Thmor' => 'Kdam Thmor',
	'Keania One' => 'Keania One',
	'Kelly Slab' => 'Kelly Slab',
	'Kenia' => 'Kenia',
	'Khand' => 'Khand',
	'Khmer' => 'Khmer',
	'Khula' => 'Khula',
	'Kirang Haerang' => 'Kirang Haerang',
	'Kite One' => 'Kite One',
	'Kiwi Maru' => 'Kiwi Maru',
	'Klee One' => 'Klee One',
	'Knewave' => 'Knewave',
	'KoHo' => 'KoHo',
	'Kodchasan' => 'Kodchasan',
	'Koh Santepheap' => 'Koh Santepheap',
	'Kosugi' => 'Kosugi',
	'Kosugi Maru' => 'Kosugi Maru',
	'Kotta One' => 'Kotta One',
	'Koulen' => 'Koulen',
	'Kranky' => 'Kranky',
	'Kreon' => 'Kreon',
	'Kristi' => 'Kristi',
	'Krona One' => 'Krona One',
	'Krub' => 'Krub',
	'Kufam' => 'Kufam',
	'Kulim Park' => 'Kulim Park',
	'Kumar One' => 'Kumar One',
	'Kumar One Outline' => 'Kumar One Outline',
	'Kumbh Sans' => 'Kumbh Sans',
	'Kurale' => 'Kurale',
	'La Belle Aurore' => 'La Belle Aurore',
	'Lacquer' => 'Lacquer',
	'Laila' => 'Laila',
	'Lakki Reddy' => 'Lakki Reddy',
	'Lalezar' => 'Lalezar',
	'Lancelot' => 'Lancelot',
	'Langar' => 'Langar',
	'Lateef' => 'Lateef',
	'Lato' => 'Lato',
	'League Script' => 'League Script',
	'Leckerli One' => 'Leckerli One',
	'Ledger' => 'Ledger',
	'Lekton' => 'Lekton',
	'Lemon' => 'Lemon',
	'Lemonada' => 'Lemonada',
	'Lexend' => 'Lexend',
	'Lexend Deca' => 'Lexend Deca',
	'Lexend Exa' => 'Lexend Exa',
	'Lexend Giga' => 'Lexend Giga',
	'Lexend Mega' => 'Lexend Mega',
	'Lexend Peta' => 'Lexend Peta',
	'Lexend Tera' => 'Lexend Tera',
	'Lexend Zetta' => 'Lexend Zetta',
	'Libre Barcode 128' => 'Libre Barcode 128',
	'Libre Barcode 128 Text' => 'Libre Barcode 128 Text',
	'Libre Barcode 39' => 'Libre Barcode 39',
	'Libre Barcode 39 Extended' => 'Libre Barcode 39 Extended',
	'Libre Barcode 39 Extended Text' => 'Libre Barcode 39 Extended Text',
	'Libre Barcode 39 Text' => 'Libre Barcode 39 Text',
	'Libre Barcode EAN13 Text' => 'Libre Barcode EAN13 Text',
	'Libre Baskerville' => 'Libre Baskerville',
	'Libre Caslon Display' => 'Libre Caslon Display',
	'Libre Caslon Text' => 'Libre Caslon Text',
	'Libre Franklin' => 'Libre Franklin',
	'Life Savers' => 'Life Savers',
	'Lilita One' => 'Lilita One',
	'Lily Script One' => 'Lily Script One',
	'Limelight' => 'Limelight',
	'Linden Hill' => 'Linden Hill',
	'Literata' => 'Literata',
	'Liu Jian Mao Cao' => 'Liu Jian Mao Cao',
	'Livvic' => 'Livvic',
	'Lobster' => 'Lobster',
	'Lobster Two' => 'Lobster Two',
	'Londrina Outline' => 'Londrina Outline',
	'Londrina Shadow' => 'Londrina Shadow',
	'Londrina Sketch' => 'Londrina Sketch',
	'Londrina Solid' => 'Londrina Solid',
	'Long Cang' => 'Long Cang',
	'Lora' => 'Lora',
	'Love Ya Like A Sister' => 'Love Ya Like A Sister',
	'Loved by the King' => 'Loved by the King',
	'Lovers Quarrel' => 'Lovers Quarrel',
	'Luckiest Guy' => 'Luckiest Guy',
	'Lusitana' => 'Lusitana',
	'Lustria' => 'Lustria',
	'M PLUS 1p' => 'M PLUS 1p',
	'M PLUS Rounded 1c' => 'M PLUS Rounded 1c',
	'Ma Shan Zheng' => 'Ma Shan Zheng',
	'Macondo' => 'Macondo',
	'Macondo Swash Caps' => 'Macondo Swash Caps',
	'Mada' => 'Mada',
	'Magra' => 'Magra',
	'Maiden Orange' => 'Maiden Orange',
	'Maitree' => 'Maitree',
	'Major Mono Display' => 'Major Mono Display',
	'Mako' => 'Mako',
	'Mali' => 'Mali',
	'Mallanna' => 'Mallanna',
	'Mandali' => 'Mandali',
	'Manjari' => 'Manjari',
	'Manrope' => 'Manrope',
	'Mansalva' => 'Mansalva',
	'Manuale' => 'Manuale',
	'Marcellus' => 'Marcellus',
	'Marcellus SC' => 'Marcellus SC',
	'Marck Script' => 'Marck Script',
	'Margarine' => 'Margarine',
	'Markazi Text' => 'Markazi Text',
	'Marko One' => 'Marko One',
	'Marmelad' => 'Marmelad',
	'Martel' => 'Martel',
	'Martel Sans' => 'Martel Sans',
	'Marvel' => 'Marvel',
	'Mate' => 'Mate',
	'Mate SC' => 'Mate SC',
	'Maven Pro' => 'Maven Pro',
	'McLaren' => 'McLaren',
	'Meddon' => 'Meddon',
	'MedievalSharp' => 'MedievalSharp',
	'Medula One' => 'Medula One',
	'Meera Inimai' => 'Meera Inimai',
	'Megrim' => 'Megrim',
	'Meie Script' => 'Meie Script',
	'Merienda' => 'Merienda',
	'Merienda One' => 'Merienda One',
	'Merriweather' => 'Merriweather',
	'Merriweather Sans' => 'Merriweather Sans',
	'Metal' => 'Metal',
	'Metal Mania' => 'Metal Mania',
	'Metamorphous' => 'Metamorphous',
	'Metrophobic' => 'Metrophobic',
	'Michroma' => 'Michroma',
	'Milonga' => 'Milonga',
	'Miltonian' => 'Miltonian',
	'Miltonian Tattoo' => 'Miltonian Tattoo',
	'Mina' => 'Mina',
	'Miniver' => 'Miniver',
	'Miriam Libre' => 'Miriam Libre',
	'Mirza' => 'Mirza',
	'Miss Fajardose' => 'Miss Fajardose',
	'Mitr' => 'Mitr',
	'Modak' => 'Modak',
	'Modern Antiqua' => 'Modern Antiqua',
	'Mogra' => 'Mogra',
	'Molengo' => 'Molengo',
	'Molle' => 'Molle',
	'Monda' => 'Monda',
	'Monofett' => 'Monofett',
	'Monoton' => 'Monoton',
	'Monsieur La Doulaise' => 'Monsieur La Doulaise',
	'Montaga' => 'Montaga',
	'MonteCarlo' => 'MonteCarlo',
	'Montez' => 'Montez',
	'Montserrat' => 'Montserrat',
	'Montserrat Alternates' => 'Montserrat Alternates',
	'Montserrat Subrayada' => 'Montserrat Subrayada',
	'Moul' => 'Moul',
	'Moulpali' => 'Moulpali',
	'Mountains of Christmas' => 'Mountains of Christmas',
	'Mouse Memoirs' => 'Mouse Memoirs',
	'Mr Bedfort' => 'Mr Bedfort',
	'Mr Dafoe' => 'Mr Dafoe',
	'Mr De Haviland' => 'Mr De Haviland',
	'Mrs Saint Delafield' => 'Mrs Saint Delafield',
	'Mrs Sheppards' => 'Mrs Sheppards',
	'Mukta' => 'Mukta',
	'Mukta Mahee' => 'Mukta Mahee',
	'Mukta Malar' => 'Mukta Malar',
	'Mukta Vaani' => 'Mukta Vaani',
	'Mulish' => 'Mulish',
	'MuseoModerno' => 'MuseoModerno',
	'Mystery Quest' => 'Mystery Quest',
	'NTR' => 'NTR',
	'Nanum Brush Script' => 'Nanum Brush Script',
	'Nanum Gothic' => 'Nanum Gothic',
	'Nanum Gothic Coding' => 'Nanum Gothic Coding',
	'Nanum Myeongjo' => 'Nanum Myeongjo',
	'Nanum Pen Script' => 'Nanum Pen Script',
	'Nerko One' => 'Nerko One',
	'Neucha' => 'Neucha',
	'Neuton' => 'Neuton',
	'New Rocker' => 'New Rocker',
	'New Tegomin' => 'New Tegomin',
	'News Cycle' => 'News Cycle',
	'Newsreader' => 'Newsreader',
	'Niconne' => 'Niconne',
	'Niramit' => 'Niramit',
	'Nixie One' => 'Nixie One',
	'Nobile' => 'Nobile',
	'Nokora' => 'Nokora',
	'Norican' => 'Norican',
	'Nosifer' => 'Nosifer',
	'Notable' => 'Notable',
	'Nothing You Could Do' => 'Nothing You Could Do',
	'Noticia Text' => 'Noticia Text',
	'Noto Kufi Arabic' => 'Noto Kufi Arabic',
	'Noto Music' => 'Noto Music',
	'Noto Naskh Arabic' => 'Noto Naskh Arabic',
	'Noto Nastaliq Urdu' => 'Noto Nastaliq Urdu',
	'Noto Rashi Hebrew' => 'Noto Rashi Hebrew',
	'Noto Sans' => 'Noto Sans',
	'Noto Sans Adlam' => 'Noto Sans Adlam',
	'Noto Sans Adlam Unjoined' => 'Noto Sans Adlam Unjoined',
	'Noto Sans Anatolian Hieroglyphs' => 'Noto Sans Anatolian Hieroglyphs',
	'Noto Sans Arabic' => 'Noto Sans Arabic',
	'Noto Sans Armenian' => 'Noto Sans Armenian',
	'Noto Sans Avestan' => 'Noto Sans Avestan',
	'Noto Sans Balinese' => 'Noto Sans Balinese',
	'Noto Sans Bamum' => 'Noto Sans Bamum',
	'Noto Sans Bassa Vah' => 'Noto Sans Bassa Vah',
	'Noto Sans Batak' => 'Noto Sans Batak',
	'Noto Sans Bengali' => 'Noto Sans Bengali',
	'Noto Sans Bhaiksuki' => 'Noto Sans Bhaiksuki',
	'Noto Sans Brahmi' => 'Noto Sans Brahmi',
	'Noto Sans Buginese' => 'Noto Sans Buginese',
	'Noto Sans Buhid' => 'Noto Sans Buhid',
	'Noto Sans Canadian Aboriginal' => 'Noto Sans Canadian Aboriginal',
	'Noto Sans Carian' => 'Noto Sans Carian',
	'Noto Sans Caucasian Albanian' => 'Noto Sans Caucasian Albanian',
	'Noto Sans Chakma' => 'Noto Sans Chakma',
	'Noto Sans Cham' => 'Noto Sans Cham',
	'Noto Sans Cherokee' => 'Noto Sans Cherokee',
	'Noto Sans Coptic' => 'Noto Sans Coptic',
	'Noto Sans Cuneiform' => 'Noto Sans Cuneiform',
	'Noto Sans Cypriot' => 'Noto Sans Cypriot',
	'Noto Sans Deseret' => 'Noto Sans Deseret',
	'Noto Sans Devanagari' => 'Noto Sans Devanagari',
	'Noto Sans Display' => 'Noto Sans Display',
	'Noto Sans Duployan' => 'Noto Sans Duployan',
	'Noto Sans Egyptian Hieroglyphs' => 'Noto Sans Egyptian Hieroglyphs',
	'Noto Sans Elbasan' => 'Noto Sans Elbasan',
	'Noto Sans Elymaic' => 'Noto Sans Elymaic',
	'Noto Sans Georgian' => 'Noto Sans Georgian',
	'Noto Sans Glagolitic' => 'Noto Sans Glagolitic',
	'Noto Sans Gothic' => 'Noto Sans Gothic',
	'Noto Sans Grantha' => 'Noto Sans Grantha',
	'Noto Sans Gujarati' => 'Noto Sans Gujarati',
	'Noto Sans Gunjala Gondi' => 'Noto Sans Gunjala Gondi',
	'Noto Sans Gurmukhi' => 'Noto Sans Gurmukhi',
	'Noto Sans HK' => 'Noto Sans HK',
	'Noto Sans Hanifi Rohingya' => 'Noto Sans Hanifi Rohingya',
	'Noto Sans Hanunoo' => 'Noto Sans Hanunoo',
	'Noto Sans Hatran' => 'Noto Sans Hatran',
	'Noto Sans Hebrew' => 'Noto Sans Hebrew',
	'Noto Sans Imperial Aramaic' => 'Noto Sans Imperial Aramaic',
	'Noto Sans Indic Siyaq Numbers' => 'Noto Sans Indic Siyaq Numbers',
	'Noto Sans Inscriptional Pahlavi' => 'Noto Sans Inscriptional Pahlavi',
	'Noto Sans Inscriptional Parthian' => 'Noto Sans Inscriptional Parthian',
	'Noto Sans JP' => 'Noto Sans JP',
	'Noto Sans Javanese' => 'Noto Sans Javanese',
	'Noto Sans KR' => 'Noto Sans KR',
	'Noto Sans Kaithi' => 'Noto Sans Kaithi',
	'Noto Sans Kannada' => 'Noto Sans Kannada',
	'Noto Sans Kayah Li' => 'Noto Sans Kayah Li',
	'Noto Sans Kharoshthi' => 'Noto Sans Kharoshthi',
	'Noto Sans Khmer' => 'Noto Sans Khmer',
	'Noto Sans Khojki' => 'Noto Sans Khojki',
	'Noto Sans Khudawadi' => 'Noto Sans Khudawadi',
	'Noto Sans Lao' => 'Noto Sans Lao',
	'Noto Sans Lepcha' => 'Noto Sans Lepcha',
	'Noto Sans Limbu' => 'Noto Sans Limbu',
	'Noto Sans Linear A' => 'Noto Sans Linear A',
	'Noto Sans Linear B' => 'Noto Sans Linear B',
	'Noto Sans Lisu' => 'Noto Sans Lisu',
	'Noto Sans Lycian' => 'Noto Sans Lycian',
	'Noto Sans Lydian' => 'Noto Sans Lydian',
	'Noto Sans Mahajani' => 'Noto Sans Mahajani',
	'Noto Sans Malayalam' => 'Noto Sans Malayalam',
	'Noto Sans Mandaic' => 'Noto Sans Mandaic',
	'Noto Sans Manichaean' => 'Noto Sans Manichaean',
	'Noto Sans Marchen' => 'Noto Sans Marchen',
	'Noto Sans Masaram Gondi' => 'Noto Sans Masaram Gondi',
	'Noto Sans Math' => 'Noto Sans Math',
	'Noto Sans Mayan Numerals' => 'Noto Sans Mayan Numerals',
	'Noto Sans Medefaidrin' => 'Noto Sans Medefaidrin',
	'Noto Sans Meroitic' => 'Noto Sans Meroitic',
	'Noto Sans Miao' => 'Noto Sans Miao',
	'Noto Sans Modi' => 'Noto Sans Modi',
	'Noto Sans Mongolian' => 'Noto Sans Mongolian',
	'Noto Sans Mono' => 'Noto Sans Mono',
	'Noto Sans Mro' => 'Noto Sans Mro',
	'Noto Sans Multani' => 'Noto Sans Multani',
	'Noto Sans Myanmar' => 'Noto Sans Myanmar',
	'Noto Sans N Ko' => 'Noto Sans N Ko',
	'Noto Sans Nabataean' => 'Noto Sans Nabataean',
	'Noto Sans New Tai Lue' => 'Noto Sans New Tai Lue',
	'Noto Sans Newa' => 'Noto Sans Newa',
	'Noto Sans Nushu' => 'Noto Sans Nushu',
	'Noto Sans Ogham' => 'Noto Sans Ogham',
	'Noto Sans Ol Chiki' => 'Noto Sans Ol Chiki',
	'Noto Sans Old Hungarian' => 'Noto Sans Old Hungarian',
	'Noto Sans Old Italic' => 'Noto Sans Old Italic',
	'Noto Sans Old North Arabian' => 'Noto Sans Old North Arabian',
	'Noto Sans Old Permic' => 'Noto Sans Old Permic',
	'Noto Sans Old Persian' => 'Noto Sans Old Persian',
	'Noto Sans Old Sogdian' => 'Noto Sans Old Sogdian',
	'Noto Sans Old South Arabian' => 'Noto Sans Old South Arabian',
	'Noto Sans Old Turkic' => 'Noto Sans Old Turkic',
	'Noto Sans Oriya' => 'Noto Sans Oriya',
	'Noto Sans Osage' => 'Noto Sans Osage',
	'Noto Sans Osmanya' => 'Noto Sans Osmanya',
	'Noto Sans Pahawh Hmong' => 'Noto Sans Pahawh Hmong',
	'Noto Sans Palmyrene' => 'Noto Sans Palmyrene',
	'Noto Sans Pau Cin Hau' => 'Noto Sans Pau Cin Hau',
	'Noto Sans Phags Pa' => 'Noto Sans Phags Pa',
	'Noto Sans Phoenician' => 'Noto Sans Phoenician',
	'Noto Sans Psalter Pahlavi' => 'Noto Sans Psalter Pahlavi',
	'Noto Sans Rejang' => 'Noto Sans Rejang',
	'Noto Sans Runic' => 'Noto Sans Runic',
	'Noto Sans SC' => 'Noto Sans SC',
	'Noto Sans Samaritan' => 'Noto Sans Samaritan',
	'Noto Sans Saurashtra' => 'Noto Sans Saurashtra',
	'Noto Sans Sharada' => 'Noto Sans Sharada',
	'Noto Sans Shavian' => 'Noto Sans Shavian',
	'Noto Sans Siddham' => 'Noto Sans Siddham',
	'Noto Sans Sinhala' => 'Noto Sans Sinhala',
	'Noto Sans Sogdian' => 'Noto Sans Sogdian',
	'Noto Sans Sora Sompeng' => 'Noto Sans Sora Sompeng',
	'Noto Sans Soyombo' => 'Noto Sans Soyombo',
	'Noto Sans Sundanese' => 'Noto Sans Sundanese',
	'Noto Sans Syloti Nagri' => 'Noto Sans Syloti Nagri',
	'Noto Sans Symbols' => 'Noto Sans Symbols',
	'Noto Sans Symbols 2' => 'Noto Sans Symbols 2',
	'Noto Sans Syriac' => 'Noto Sans Syriac',
	'Noto Sans TC' => 'Noto Sans TC',
	'Noto Sans Tagalog' => 'Noto Sans Tagalog',
	'Noto Sans Tagbanwa' => 'Noto Sans Tagbanwa',
	'Noto Sans Tai Le' => 'Noto Sans Tai Le',
	'Noto Sans Tai Tham' => 'Noto Sans Tai Tham',
	'Noto Sans Tai Viet' => 'Noto Sans Tai Viet',
	'Noto Sans Takri' => 'Noto Sans Takri',
	'Noto Sans Tamil' => 'Noto Sans Tamil',
	'Noto Sans Tamil Supplement' => 'Noto Sans Tamil Supplement',
	'Noto Sans Telugu' => 'Noto Sans Telugu',
	'Noto Sans Thaana' => 'Noto Sans Thaana',
	'Noto Sans Thai' => 'Noto Sans Thai',
	'Noto Sans Thai Looped' => 'Noto Sans Thai Looped',
	'Noto Sans Tifinagh' => 'Noto Sans Tifinagh',
	'Noto Sans Tirhuta' => 'Noto Sans Tirhuta',
	'Noto Sans Ugaritic' => 'Noto Sans Ugaritic',
	'Noto Sans Vai' => 'Noto Sans Vai',
	'Noto Sans Wancho' => 'Noto Sans Wancho',
	'Noto Sans Warang Citi' => 'Noto Sans Warang Citi',
	'Noto Sans Yi' => 'Noto Sans Yi',
	'Noto Sans Zanabazar Square' => 'Noto Sans Zanabazar Square',
	'Noto Serif' => 'Noto Serif',
	'Noto Serif Ahom' => 'Noto Serif Ahom',
	'Noto Serif Armenian' => 'Noto Serif Armenian',
	'Noto Serif Balinese' => 'Noto Serif Balinese',
	'Noto Serif Bengali' => 'Noto Serif Bengali',
	'Noto Serif Devanagari' => 'Noto Serif Devanagari',
	'Noto Serif Display' => 'Noto Serif Display',
	'Noto Serif Dogra' => 'Noto Serif Dogra',
	'Noto Serif Ethiopic' => 'Noto Serif Ethiopic',
	'Noto Serif Georgian' => 'Noto Serif Georgian',
	'Noto Serif Grantha' => 'Noto Serif Grantha',
	'Noto Serif Gujarati' => 'Noto Serif Gujarati',
	'Noto Serif Gurmukhi' => 'Noto Serif Gurmukhi',
	'Noto Serif Hebrew' => 'Noto Serif Hebrew',
	'Noto Serif JP' => 'Noto Serif JP',
	'Noto Serif KR' => 'Noto Serif KR',
	'Noto Serif Kannada' => 'Noto Serif Kannada',
	'Noto Serif Khmer' => 'Noto Serif Khmer',
	'Noto Serif Lao' => 'Noto Serif Lao',
	'Noto Serif Malayalam' => 'Noto Serif Malayalam',
	'Noto Serif Myanmar' => 'Noto Serif Myanmar',
	'Noto Serif Nyiakeng Puachue Hmong' => 'Noto Serif Nyiakeng Puachue Hmong',
	'Noto Serif SC' => 'Noto Serif SC',
	'Noto Serif Sinhala' => 'Noto Serif Sinhala',
	'Noto Serif TC' => 'Noto Serif TC',
	'Noto Serif Tamil' => 'Noto Serif Tamil',
	'Noto Serif Tangut' => 'Noto Serif Tangut',
	'Noto Serif Telugu' => 'Noto Serif Telugu',
	'Noto Serif Thai' => 'Noto Serif Thai',
	'Noto Serif Tibetan' => 'Noto Serif Tibetan',
	'Noto Serif Yezidi' => 'Noto Serif Yezidi',
	'Noto Traditional Nushu' => 'Noto Traditional Nushu',
	'Nova Cut' => 'Nova Cut',
	'Nova Flat' => 'Nova Flat',
	'Nova Mono' => 'Nova Mono',
	'Nova Oval' => 'Nova Oval',
	'Nova Round' => 'Nova Round',
	'Nova Script' => 'Nova Script',
	'Nova Slim' => 'Nova Slim',
	'Nova Square' => 'Nova Square',
	'Numans' => 'Numans',
	'Nunito' => 'Nunito',
	'Nunito Sans' => 'Nunito Sans',
	'Odibee Sans' => 'Odibee Sans',
	'Odor Mean Chey' => 'Odor Mean Chey',
	'Offside' => 'Offside',
	'Oi' => 'Oi',
	'Old Standard TT' => 'Old Standard TT',
	'Oldenburg' => 'Oldenburg',
	'Oleo Script' => 'Oleo Script',
	'Oleo Script Swash Caps' => 'Oleo Script Swash Caps',
	'Open Sans' => 'Open Sans',
	'Open Sans Condensed' => 'Open Sans Condensed',
	'Oranienbaum' => 'Oranienbaum',
	'Orbitron' => 'Orbitron',
	'Oregano' => 'Oregano',
	'Orelega One' => 'Orelega One',
	'Orienta' => 'Orienta',
	'Original Surfer' => 'Original Surfer',
	'Oswald' => 'Oswald',
	'Otomanopee One' => 'Otomanopee One',
	'Over the Rainbow' => 'Over the Rainbow',
	'Overlock' => 'Overlock',
	'Overlock SC' => 'Overlock SC',
	'Overpass' => 'Overpass',
	'Overpass Mono' => 'Overpass Mono',
	'Ovo' => 'Ovo',
	'Oxanium' => 'Oxanium',
	'Oxygen' => 'Oxygen',
	'Oxygen Mono' => 'Oxygen Mono',
	'PT Mono' => 'PT Mono',
	'PT Sans' => 'PT Sans',
	'PT Sans Caption' => 'PT Sans Caption',
	'PT Sans Narrow' => 'PT Sans Narrow',
	'PT Serif' => 'PT Serif',
	'PT Serif Caption' => 'PT Serif Caption',
	'Pacifico' => 'Pacifico',
	'Padauk' => 'Padauk',
	'Palanquin' => 'Palanquin',
	'Palanquin Dark' => 'Palanquin Dark',
	'Palette Mosaic' => 'Palette Mosaic',
	'Pangolin' => 'Pangolin',
	'Paprika' => 'Paprika',
	'Parisienne' => 'Parisienne',
	'Passero One' => 'Passero One',
	'Passion One' => 'Passion One',
	'Pathway Gothic One' => 'Pathway Gothic One',
	'Patrick Hand' => 'Patrick Hand',
	'Patrick Hand SC' => 'Patrick Hand SC',
	'Pattaya' => 'Pattaya',
	'Patua One' => 'Patua One',
	'Pavanam' => 'Pavanam',
	'Paytone One' => 'Paytone One',
	'Peddana' => 'Peddana',
	'Peralta' => 'Peralta',
	'Permanent Marker' => 'Permanent Marker',
	'Petit Formal Script' => 'Petit Formal Script',
	'Petrona' => 'Petrona',
	'Philosopher' => 'Philosopher',
	'Piazzolla' => 'Piazzolla',
	'Piedra' => 'Piedra',
	'Pinyon Script' => 'Pinyon Script',
	'Pirata One' => 'Pirata One',
	'Plaster' => 'Plaster',
	'Play' => 'Play',
	'Playball' => 'Playball',
	'Playfair Display' => 'Playfair Display',
	'Playfair Display SC' => 'Playfair Display SC',
	'Podkova' => 'Podkova',
	'Poiret One' => 'Poiret One',
	'Poller One' => 'Poller One',
	'Poly' => 'Poly',
	'Pompiere' => 'Pompiere',
	'Pontano Sans' => 'Pontano Sans',
	'Poor Story' => 'Poor Story',
	'Poppins' => 'Poppins',
	'Port Lligat Sans' => 'Port Lligat Sans',
	'Port Lligat Slab' => 'Port Lligat Slab',
	'Potta One' => 'Potta One',
	'Pragati Narrow' => 'Pragati Narrow',
	'Prata' => 'Prata',
	'Preahvihear' => 'Preahvihear',
	'Press Start 2P' => 'Press Start 2P',
	'Pridi' => 'Pridi',
	'Princess Sofia' => 'Princess Sofia',
	'Prociono' => 'Prociono',
	'Prompt' => 'Prompt',
	'Prosto One' => 'Prosto One',
	'Proza Libre' => 'Proza Libre',
	'Public Sans' => 'Public Sans',
	'Puritan' => 'Puritan',
	'Purple Purse' => 'Purple Purse',
	'Qahiri' => 'Qahiri',
	'Quando' => 'Quando',
	'Quantico' => 'Quantico',
	'Quattrocento' => 'Quattrocento',
	'Quattrocento Sans' => 'Quattrocento Sans',
	'Questrial' => 'Questrial',
	'Quicksand' => 'Quicksand',
	'Quintessential' => 'Quintessential',
	'Qwigley' => 'Qwigley',
	'Racing Sans One' => 'Racing Sans One',
	'Radley' => 'Radley',
	'Rajdhani' => 'Rajdhani',
	'Rakkas' => 'Rakkas',
	'Raleway' => 'Raleway',
	'Raleway Dots' => 'Raleway Dots',
	'Ramabhadra' => 'Ramabhadra',
	'Ramaraja' => 'Ramaraja',
	'Rambla' => 'Rambla',
	'Rammetto One' => 'Rammetto One',
	'Rampart One' => 'Rampart One',
	'Ranchers' => 'Ranchers',
	'Rancho' => 'Rancho',
	'Ranga' => 'Ranga',
	'Rasa' => 'Rasa',
	'Rationale' => 'Rationale',
	'Ravi Prakash' => 'Ravi Prakash',
	'Recursive' => 'Recursive',
	'Red Hat Display' => 'Red Hat Display',
	'Red Hat Text' => 'Red Hat Text',
	'Red Rose' => 'Red Rose',
	'Redressed' => 'Redressed',
	'Reem Kufi' => 'Reem Kufi',
	'Reenie Beanie' => 'Reenie Beanie',
	'Reggae One' => 'Reggae One',
	'Revalia' => 'Revalia',
	'Rhodium Libre' => 'Rhodium Libre',
	'Ribeye' => 'Ribeye',
	'Ribeye Marrow' => 'Ribeye Marrow',
	'Righteous' => 'Righteous',
	'Risque' => 'Risque',
	'Roboto' => 'Roboto',
	'Roboto Condensed' => 'Roboto Condensed',
	'Roboto Mono' => 'Roboto Mono',
	'Roboto Slab' => 'Roboto Slab',
	'Rochester' => 'Rochester',
	'Rock Salt' => 'Rock Salt',
	'RocknRoll One' => 'RocknRoll One',
	'Rokkitt' => 'Rokkitt',
	'Romanesco' => 'Romanesco',
	'Ropa Sans' => 'Ropa Sans',
	'Rosario' => 'Rosario',
	'Rosarivo' => 'Rosarivo',
	'Rouge Script' => 'Rouge Script',
	'Rowdies' => 'Rowdies',
	'Rozha One' => 'Rozha One',
	'Rubik' => 'Rubik',
	'Rubik Beastly' => 'Rubik Beastly',
	'Rubik Mono One' => 'Rubik Mono One',
	'Ruda' => 'Ruda',
	'Rufina' => 'Rufina',
	'Ruge Boogie' => 'Ruge Boogie',
	'Ruluko' => 'Ruluko',
	'Rum Raisin' => 'Rum Raisin',
	'Ruslan Display' => 'Ruslan Display',
	'Russo One' => 'Russo One',
	'Ruthie' => 'Ruthie',
	'Rye' => 'Rye',
	'STIX Two Text' => 'STIX Two Text',
	'Sacramento' => 'Sacramento',
	'Sahitya' => 'Sahitya',
	'Sail' => 'Sail',
	'Saira' => 'Saira',
	'Saira Condensed' => 'Saira Condensed',
	'Saira Extra Condensed' => 'Saira Extra Condensed',
	'Saira Semi Condensed' => 'Saira Semi Condensed',
	'Saira Stencil One' => 'Saira Stencil One',
	'Salsa' => 'Salsa',
	'Sanchez' => 'Sanchez',
	'Sancreek' => 'Sancreek',
	'Sansita' => 'Sansita',
	'Sansita Swashed' => 'Sansita Swashed',
	'Sarabun' => 'Sarabun',
	'Sarala' => 'Sarala',
	'Sarina' => 'Sarina',
	'Sarpanch' => 'Sarpanch',
	'Satisfy' => 'Satisfy',
	'Sawarabi Gothic' => 'Sawarabi Gothic',
	'Sawarabi Mincho' => 'Sawarabi Mincho',
	'Scada' => 'Scada',
	'Scheherazade' => 'Scheherazade',
	'Scheherazade New' => 'Scheherazade New',
	'Schoolbell' => 'Schoolbell',
	'Scope One' => 'Scope One',
	'Seaweed Script' => 'Seaweed Script',
	'Secular One' => 'Secular One',
	'Sedgwick Ave' => 'Sedgwick Ave',
	'Sedgwick Ave Display' => 'Sedgwick Ave Display',
	'Sen' => 'Sen',
	'Sevillana' => 'Sevillana',
	'Seymour One' => 'Seymour One',
	'Shadows Into Light' => 'Shadows Into Light',
	'Shadows Into Light Two' => 'Shadows Into Light Two',
	'Shanti' => 'Shanti',
	'Share' => 'Share',
	'Share Tech' => 'Share Tech',
	'Share Tech Mono' => 'Share Tech Mono',
	'Shippori Mincho' => 'Shippori Mincho',
	'Shippori Mincho B1' => 'Shippori Mincho B1',
	'Shojumaru' => 'Shojumaru',
	'Short Stack' => 'Short Stack',
	'Shrikhand' => 'Shrikhand',
	'Siemreap' => 'Siemreap',
	'Sigmar One' => 'Sigmar One',
	'Signika' => 'Signika',
	'Signika Negative' => 'Signika Negative',
	'Simonetta' => 'Simonetta',
	'Single Day' => 'Single Day',
	'Sintony' => 'Sintony',
	'Sirin Stencil' => 'Sirin Stencil',
	'Six Caps' => 'Six Caps',
	'Skranji' => 'Skranji',
	'Slabo 13px' => 'Slabo 13px',
	'Slabo 27px' => 'Slabo 27px',
	'Slackey' => 'Slackey',
	'Smokum' => 'Smokum',
	'Smythe' => 'Smythe',
	'Sniglet' => 'Sniglet',
	'Snippet' => 'Snippet',
	'Snowburst One' => 'Snowburst One',
	'Sofadi One' => 'Sofadi One',
	'Sofia' => 'Sofia',
	'Solway' => 'Solway',
	'Song Myung' => 'Song Myung',
	'Sonsie One' => 'Sonsie One',
	'Sora' => 'Sora',
	'Sorts Mill Goudy' => 'Sorts Mill Goudy',
	'Source Code Pro' => 'Source Code Pro',
	'Source Sans Pro' => 'Source Sans Pro',
	'Source Serif Pro' => 'Source Serif Pro',
	'Space Grotesk' => 'Space Grotesk',
	'Space Mono' => 'Space Mono',
	'Spartan' => 'Spartan',
	'Special Elite' => 'Special Elite',
	'Spectral' => 'Spectral',
	'Spectral SC' => 'Spectral SC',
	'Spicy Rice' => 'Spicy Rice',
	'Spinnaker' => 'Spinnaker',
	'Spirax' => 'Spirax',
	'Squada One' => 'Squada One',
	'Sree Krushnadevaraya' => 'Sree Krushnadevaraya',
	'Sriracha' => 'Sriracha',
	'Srisakdi' => 'Srisakdi',
	'Staatliches' => 'Staatliches',
	'Stalemate' => 'Stalemate',
	'Stalinist One' => 'Stalinist One',
	'Stardos Stencil' => 'Stardos Stencil',
	'Stick' => 'Stick',
	'Stick No Bills' => 'Stick No Bills',
	'Stint Ultra Condensed' => 'Stint Ultra Condensed',
	'Stint Ultra Expanded' => 'Stint Ultra Expanded',
	'Stoke' => 'Stoke',
	'Strait' => 'Strait',
	'Style Script' => 'Style Script',
	'Stylish' => 'Stylish',
	'Sue Ellen Francisco' => 'Sue Ellen Francisco',
	'Suez One' => 'Suez One',
	'Sulphur Point' => 'Sulphur Point',
	'Sumana' => 'Sumana',
	'Sunflower' => 'Sunflower',
	'Sunshiney' => 'Sunshiney',
	'Supermercado One' => 'Supermercado One',
	'Sura' => 'Sura',
	'Suranna' => 'Suranna',
	'Suravaram' => 'Suravaram',
	'Suwannaphum' => 'Suwannaphum',
	'Swanky and Moo Moo' => 'Swanky and Moo Moo',
	'Syncopate' => 'Syncopate',
	'Syne' => 'Syne',
	'Syne Mono' => 'Syne Mono',
	'Syne Tactile' => 'Syne Tactile',
	'Tajawal' => 'Tajawal',
	'Tangerine' => 'Tangerine',
	'Taprom' => 'Taprom',
	'Tauri' => 'Tauri',
	'Taviraj' => 'Taviraj',
	'Teko' => 'Teko',
	'Telex' => 'Telex',
	'Tenali Ramakrishna' => 'Tenali Ramakrishna',
	'Tenor Sans' => 'Tenor Sans',
	'Text Me One' => 'Text Me One',
	'Texturina' => 'Texturina',
	'Thasadith' => 'Thasadith',
	'The Girl Next Door' => 'The Girl Next Door',
	'Tienne' => 'Tienne',
	'Tillana' => 'Tillana',
	'Timmana' => 'Timmana',
	'Tinos' => 'Tinos',
	'Titan One' => 'Titan One',
	'Titillium Web' => 'Titillium Web',
	'Tomorrow' => 'Tomorrow',
	'Tourney' => 'Tourney',
	'Trade Winds' => 'Trade Winds',
	'Train One' => 'Train One',
	'Trirong' => 'Trirong',
	'Trispace' => 'Trispace',
	'Trocchi' => 'Trocchi',
	'Trochut' => 'Trochut',
	'Truculenta' => 'Truculenta',
	'Trykker' => 'Trykker',
	'Tulpen One' => 'Tulpen One',
	'Turret Road' => 'Turret Road',
	'Ubuntu' => 'Ubuntu',
	'Ubuntu Condensed' => 'Ubuntu Condensed',
	'Ubuntu Mono' => 'Ubuntu Mono',
	'Uchen' => 'Uchen',
	'Ultra' => 'Ultra',
	'Uncial Antiqua' => 'Uncial Antiqua',
	'Underdog' => 'Underdog',
	'Unica One' => 'Unica One',
	'UnifrakturCook' => 'UnifrakturCook',
	'UnifrakturMaguntia' => 'UnifrakturMaguntia',
	'Unkempt' => 'Unkempt',
	'Unlock' => 'Unlock',
	'Unna' => 'Unna',
	'Urbanist' => 'Urbanist',
	'VT323' => 'VT323',
	'Vampiro One' => 'Vampiro One',
	'Varela' => 'Varela',
	'Varela Round' => 'Varela Round',
	'Varta' => 'Varta',
	'Vast Shadow' => 'Vast Shadow',
	'Vesper Libre' => 'Vesper Libre',
	'Viaoda Libre' => 'Viaoda Libre',
	'Vibes' => 'Vibes',
	'Vibur' => 'Vibur',
	'Vidaloka' => 'Vidaloka',
	'Viga' => 'Viga',
	'Voces' => 'Voces',
	'Volkhov' => 'Volkhov',
	'Vollkorn' => 'Vollkorn',
	'Vollkorn SC' => 'Vollkorn SC',
	'Voltaire' => 'Voltaire',
	'Waiting for the Sunrise' => 'Waiting for the Sunrise',
	'Wallpoet' => 'Wallpoet',
	'Walter Turncoat' => 'Walter Turncoat',
	'Warnes' => 'Warnes',
	'Wellfleet' => 'Wellfleet',
	'Wendy One' => 'Wendy One',
	'WindSong' => 'WindSong',
	'Wire One' => 'Wire One',
	'Work Sans' => 'Work Sans',
	'Xanh Mono' => 'Xanh Mono',
	'Yaldevi' => 'Yaldevi',
	'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
	'Yantramanav' => 'Yantramanav',
	'Yatra One' => 'Yatra One',
	'Yellowtail' => 'Yellowtail',
	'Yeon Sung' => 'Yeon Sung',
	'Yeseva One' => 'Yeseva One',
	'Yesteryear' => 'Yesteryear',
	'Yomogi' => 'Yomogi',
	'Yrsa' => 'Yrsa',
	'Yusei Magic' => 'Yusei Magic',
	'ZCOOL KuaiLe' => 'ZCOOL KuaiLe',
	'ZCOOL QingKe HuangYou' => 'ZCOOL QingKe HuangYou',
	'ZCOOL XiaoWei' => 'ZCOOL XiaoWei',
	'Zen Dots' => 'Zen Dots',
	'Zen Loop' => 'Zen Loop',
	'Zen Tokyo Zoo' => 'Zen Tokyo Zoo',
	'Zeyada' => 'Zeyada',
	'Zhi Mang Xing' => 'Zhi Mang Xing',
	'Zilla Slab' => 'Zilla Slab',
	'Zilla Slab Highlight' => 'Zilla Slab Highlight'
	);
	$faces = array_merge($jl_custom_font, $jl_google_font);
	// Font Size
	$font_sizes = array();
	$font_sizes_px_none = array();
	for ($i = 9; $i <= 50; $i++){ 
		$font_sizes[$i.'px'] = $i.'px';
		$font_sizes_px_none[$i] = $i.'px';
	}
	// Font Weights
	$font_weights  = array(
		'100' => esc_html__('Thin', 'shareblock'),
		'200' => esc_html__('Extra-Light', 'shareblock'),
		'300' => esc_html__('Light', 'shareblock'),
		'400' => esc_html__('Regular', 'shareblock'),
		'500' => esc_html__('Medium', 'shareblock'),
		'600' => esc_html__('Semi-Bold', 'shareblock'),
		'700' => esc_html__('Bold', 'shareblock'),
		'800' => esc_html__('Extra-Bold', 'shareblock'),
		'900' => esc_html__('Black', 'shareblock')
	);
	
	$wp_customize->add_panel( 'shareblock_theme_options', array(
	    'priority' => 1,
	    'title' => esc_html__( 'Theme Options', 'shareblock' ),
	    'description' => esc_html__( 'Options for theme customizing', 'shareblock' ),
	));

	$wp_customize->add_section( 
		'shareblock_logo_favicon' , 
		array(
   		'title'      => esc_html__( 'Logo Settings', 'shareblock' ),
   		'description'=> esc_html__( 'Please choose your logo', 'shareblock' ),
   		'priority'  => 1,
   		'panel' => 'shareblock_theme_options'
	));
    $wp_customize->add_setting( 
    'shareblock_logo', 
    array(
	'default' 			=> '',
	'transport'   		=> 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
	));
    $wp_customize->add_control( 
    	new WP_Customize_Image_Control( 
    	$wp_customize, 
    	'shareblock_logo', 
    	array(
        'label'    => esc_html__( 'Normal Logo', 'shareblock' ),
        'section'  => 'shareblock_logo_favicon',
        'settings' => 'shareblock_logo'
    )));

    $wp_customize->add_setting( 
    'shareblock_logow', 
    array(
	'default' 			=> '',
	'transport'   		=> 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
	));
    $wp_customize->add_control( 
    	new WP_Customize_Image_Control( 
    	$wp_customize, 
    	'shareblock_logow', 
    	array(
        'label'    => esc_html__( 'White Logo', 'shareblock' ),
        'section'  => 'shareblock_logo_favicon',
        'settings' => 'shareblock_logow'
    )));

    $wp_customize->add_setting( 
    'shareblock_flogo', 
    array(
	'default' 			=> '',
	'transport'   		=> 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
	));
    $wp_customize->add_control( 
    	new WP_Customize_Image_Control( 
    	$wp_customize, 
    	'shareblock_flogo', 
    	array(
        'label'    => esc_html__( 'Footer Logo', 'shareblock' ),
        'section'  => 'shareblock_logo_favicon',
        'settings' => 'shareblock_flogo'
    )));

    $wp_customize->add_setting(
	    'logo_width',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'logo_width',
	    array(
	        'section'   => 'shareblock_logo_favicon',
	        'label'     => esc_html__('Desktop Logo Width EX: 100px','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    't_logo_width',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    't_logo_width',
	    array(
	        'section'   => 'shareblock_logo_favicon',
	        'label'     => esc_html__('Tablet Logo Width EX: 100px','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'm_logo_width',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'm_logo_width',
	    array(
	        'section'   => 'shareblock_logo_favicon',
	        'label'     => esc_html__('Mobile Logo Width EX: 100px','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    's_logo_width',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    's_logo_width',
	    array(
	        'section'   => 'shareblock_logo_favicon',
	        'label'     => esc_html__('Sidebar Logo Width EX: 100px','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'f_logo_width',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'f_logo_width',
	    array(
	        'section'   => 'shareblock_logo_favicon',
	        'label'     => esc_html__('Footer Logo Width EX: 100px','shareblock'),
	        'type'      => 'text'
	    )
	);

	/*General Setting*/
	$wp_customize->add_section(
		    'shareblock_general_setting',
		    array(
		        'title'     => esc_html__('General Settings', 'shareblock'),
		        'priority'  => 1,
		        'panel' => 'shareblock_theme_options'
		    )
	);

	$wp_customize->add_setting(
	    'theme_color',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'theme_color',
	        array(
	            'label'      => esc_html__( 'Theme color', 'shareblock' ),
	            'section'    => 'shareblock_general_setting',
	            'settings'   => 'theme_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'border_rounded',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'border_rounded',
	    array(
	        'section'   => 'shareblock_general_setting',
	        'label'     => esc_html__('Border Rounded  EX: 10px','shareblock'),
	        'type'      => 'text'
	    )
	);


	$wp_customize->add_setting(
        'shareblock_header_settings_title',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new shareblock_Customize_Control_Title (
            $wp_customize,
            'shareblock_header_settings_title',
            array(
                'label'         => esc_html__( 'Header settings', 'shareblock' ),
                'section'       => 'shareblock_general_setting',
                'settings'      => 'shareblock_header_settings_title',
            )
        )
    );

	$wp_customize->add_setting(
	    'header_layout_design',
	    array(
	        'default'     => 'header_1',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    new shareblock_control_image_select (
	        $wp_customize,
	        'header_layout_design',
	        array(
	            'label'      	=> esc_html__( 'Header Layout (header menu and logo)', 'shareblock' ),
	            'description'	=> esc_html__('Select header style.', 'shareblock'),
	            'section'		=> 'shareblock_general_setting',
	            'settings'		=> 'header_layout_design',
	            'choices'		=> array(
	            	'header_1'  => get_template_directory_uri().'/inc/customizer/images/header1.png',
                    'header_2' => get_template_directory_uri().'/inc/customizer/images/header2.png',
                    'header_3'   => get_template_directory_uri().'/inc/customizer/images/header3.png',
                    'header_4'   => get_template_directory_uri().'/inc/customizer/images/header4.png',
                    'header_5'    => get_template_directory_uri().'/inc/customizer/images/header5.png',
                    'header_6'   => get_template_directory_uri().'/inc/customizer/images/header6.png',
	            	
	            ),
	            'input_attrs' => array(
	            	'multiple' => false
	            )
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_header_width',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_header_width',
	    array(
	        'section'   => 'shareblock_general_setting',
	        'label'     => esc_html__('Header width  EX: 1300px, 100%','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_header_height',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_header_height',
	    array(
	        'section'   => 'shareblock_general_setting',
	        'label'     => esc_html__('Desktop header height  EX: 100px','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_t_header_height',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_t_header_height',
	    array(
	        'section'   => 'shareblock_general_setting',
	        'label'     => esc_html__('Tablet header height  EX: 100px','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_m_header_height',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_m_header_height',
	    array(
	        'section'   => 'shareblock_general_setting',
	        'label'     => esc_html__('Mobile header height  EX: 100px','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_menu_align',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_menu_align',
	    array(
	        'section'   => 'shareblock_general_setting',
	        'label'     => esc_html__('Menu alignment','shareblock'),
	        'type'      => 'select',
	        'choices'	=> array(
	        '' => esc_html__('Default', 'shareblock'),
			'left' => esc_html__('Left', 'shareblock'),			
			'center' => esc_html__('Center', 'shareblock'),			
			'right' => esc_html__('Right', 'shareblock')			
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_header_space',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_header_space',
	    array(
	        'section'   => 'shareblock_general_setting',
	        'label'     => esc_html__('Desktop header space  EX: 100px','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_t_header_space',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_t_header_space',
	    array(
	        'section'   => 'shareblock_general_setting',
	        'label'     => esc_html__('Tablet header space  EX: 100px','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_m_header_space',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_m_header_space',
	    array(
	        'section'   => 'shareblock_general_setting',
	        'label'     => esc_html__('Mobile header space EX: 100px','shareblock'),
	        'type'      => 'text'
	    )
	);



	$wp_customize->add_setting(
        'shareblock_top_m_title',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new shareblock_Customize_Control_Title (
            $wp_customize,
            'shareblock_top_m_title',
            array(
                'label'         => esc_html__( 'Top menu settings', 'shareblock' ),
                'section'       => 'shareblock_general_setting',
                'settings'      => 'shareblock_top_m_title',
            )
        )
    );

    $wp_customize->add_setting(
        'disable_top_bar', 
        array(
            'default' => false, 
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'disable_top_bar',
        array(
            'section'   => 'shareblock_general_setting',
            'label'     => esc_html__('Disable top bar','shareblock'),
            'type'      => 'checkbox'
        )
    );


	$wp_customize->add_setting(
        'enable_dark_mode', 
        array(
            'default' => false, 
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'enable_dark_mode',
        array(
            'section'   => 'shareblock_general_setting',
            'label'     => esc_html__('Enable dark mode button','shareblock'),
            'type'      => 'checkbox'
        )
    );


    $wp_customize->add_setting(
	    'top_menu_bg_color',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'top_menu_bg_color',
	        array(
	            'label'      => esc_html__( 'Top Menu Background', 'shareblock' ),
	            'section'    => 'shareblock_general_setting',
	            'settings'   => 'top_menu_bg_color'
	        )
	    )
	);
	$wp_customize->add_setting(
	    'to_menu_text_color',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'to_menu_text_color',
	        array(
	            'label'      => esc_html__( 'Top Menu text color', 'shareblock' ),
	            'section'    => 'shareblock_general_setting',
	            'settings'   => 'to_menu_text_color'
	        )
	    )
	);





	$wp_customize->add_setting(
        'shareblock_main_m_title',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new shareblock_Customize_Control_Title (
            $wp_customize,
            'shareblock_main_m_title',
            array(
                'label'         => esc_html__( 'Main menu settings', 'shareblock' ),
                'section'       => 'shareblock_general_setting',
                'settings'      => 'shareblock_main_m_title',
            )
        )
    );

	$wp_customize->add_setting(
	    'menu_bg_color',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'menu_bg_color',
	        array(
	            'label'      => esc_html__( 'Main Menu Background', 'shareblock' ),
	            'section'    => 'shareblock_general_setting',
	            'settings'   => 'menu_bg_color'
	        )
	    )
	);
	
	$wp_customize->add_setting(
	    'menu_text_color',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'menu_text_color',
	        array(
	            'label'      => esc_html__( 'Main Menu text color', 'shareblock' ),
	            'section'    => 'shareblock_general_setting',
	            'settings'   => 'menu_text_color'
	        )
	    )
	);

	$wp_customize->add_setting(
        'shareblock_other_title',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new shareblock_Customize_Control_Title (
            $wp_customize,
            'shareblock_other_title',
            array(
                'label'         => esc_html__( 'Other settings', 'shareblock' ),
                'section'       => 'shareblock_general_setting',
                'settings'      => 'shareblock_other_title',
            )
        )
    );

$wp_customize->add_setting(
		'disable_top_search', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_top_search',
	    array(
	        'section'   => 'shareblock_general_setting',
	        'label'     => esc_html__('Disable header search','shareblock'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_sticky_menu', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_sticky_menu',
	    array(
	        'section'   => 'shareblock_general_setting',
	        'label'     => esc_html__('Disable sticky nav','shareblock'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_mb_nav', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_mb_nav',
	    array(
	        'section'   => 'shareblock_general_setting',
	        'label'     => esc_html__('Disable mobile nav','shareblock'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_social_icons', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_social_icons',
	    array(
	        'section'   => 'shareblock_general_setting',
	        'label'     => esc_html__('Disable social icons','shareblock'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
		'enable_dark_skin', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'enable_dark_skin',
	    array(
	        'section'   => 'shareblock_general_setting',
	        'label'     => esc_html__('Enable dark skin','shareblock'),
	        'type'      => 'checkbox'
	    )
	);		

	$wp_customize->add_setting(
	    'category_label',
	    array(
	        'default'    =>  'cat_label_1',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'category_label',
	    array(
	        'section'   => 'shareblock_general_setting',
	        'label'     => esc_html__('Category label style','shareblock'),
	        'type'      => 'select',
	        'choices'	=> array(
	        'cat_label_1' => esc_html__('Style 1', 'shareblock'),
			'cat_label_2' => esc_html__('Style 2', 'shareblock'),			
			'cat_label_3' => esc_html__('Style 3', 'shareblock'),			
			'cat_label_4' => esc_html__('Style 4', 'shareblock')			
	        )
	    )
	);

	/*Typography*/
	$wp_customize->add_section(
		    'shareblock_typography_setting',
		    array(
		        'title'     => esc_html__('Typography Settings', 'shareblock'),
		        'priority'  => 1,
		        'panel' => 'shareblock_theme_options'
		    )
	);

	$wp_customize->add_setting(
	    'shareblock_menu_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new shareblock_Customize_Control_Title (
	        $wp_customize,
	        'shareblock_menu_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Navigation Settings', 'shareblock' ),
	            'section'		=> 'shareblock_typography_setting',
	            'settings'		=> 'shareblock_menu_settings_title',
	        )
	    )
	);
	$wp_customize->add_setting(
	    'shareblock_menu_font_family',
	    array(
	        'default'     => 'DM Sans',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_menu_font_family',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Menu font family','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $faces
	    )
	);
    $wp_customize->add_setting(
	    'shareblock_menu_font_size',
	    array(
	        'default'     => '17px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_menu_font_size',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Main menu font size','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'shareblock_menu_font_weight',
	    array(
	        'default'     => '600',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_menu_font_weight',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Main menu font weight','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
	$wp_customize->add_setting(
	    'shareblock_menu_transform',
	    array(
	        'default'    =>  'capitalize',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'shareblock_menu_transform',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Menu text transform','shareblock'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'shareblock'),
	        	'capitalize' => esc_html__('Capitalize', 'shareblock'),
	        	'uppercase' => esc_html__('Uppercase', 'shareblock')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'letter_spacing_menu',
	    array(
	        'default'    =>  '-.03em',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'letter_spacing_menu',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Menu letter spacing','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'shareblock_sub_menu_font_size',
	    array(
	        'default'     => '14px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_sub_menu_font_size',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Sub menu font size','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'shareblock_sub_menu_font_weight',
	    array(
	        'default'     => '400',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_sub_menu_font_weight',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Sub menu font weight','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);

	$wp_customize->add_setting(
	    'sub_menu_transform',
	    array(
	        'default'    =>  'capitalize',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'sub_menu_transform',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Sub menu text transform','shareblock'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'shareblock'),
	        	'capitalize' => esc_html__('Capitalize', 'shareblock'),
	        	'uppercase' => esc_html__('Uppercase', 'shareblock')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'sub_spacing_menu',
	    array(
	        'default'    =>  '0em',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'sub_spacing_menu',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Sub menu letter spacing','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'shareblock_p_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new shareblock_Customize_Control_Title (
	        $wp_customize,
	        'shareblock_p_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Paragraph Settings', 'shareblock' ),
	            'section'		=> 'shareblock_typography_setting',
	            'settings'		=> 'shareblock_p_settings_title',
	        )
	    )
	);

	$wp_customize->add_setting(
	    'shareblock_p_font_family',
	    array(
	        'default'     => 'DM Sans',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_p_font_family',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Paragraph font family','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $faces
	    )
	);
	$wp_customize->add_setting(
	    'shareblock_p_font_size',
	    array(
	        'default'     => '16px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_p_font_size',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Content font size','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'p_line_height',
	    array(
	        'default'    =>  '1.8',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'p_line_height',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Content line height','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'body_font_size',
	    array(
	        'default'     => '15px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'body_font_size',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Body & excerpt font size','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'body_line_height',
	    array(
	        'default'    =>  '1.5',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'body_line_height',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Body line height','shareblock'),
	        'type'      => 'text'
	    )
	);


	$wp_customize->add_setting(
	    'shareblock_p_font_weight',
	    array(
	        'default'     => '400',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_p_font_weight',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Paragraph font weight','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);


	$wp_customize->add_setting(
	    'shareblock_title_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new shareblock_Customize_Control_Title (
	        $wp_customize,
	        'shareblock_title_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Title Settings', 'shareblock' ),
	            'section'		=> 'shareblock_typography_setting',
	            'settings'		=> 'shareblock_title_settings_title',
	        )
	    )
	);
	$wp_customize->add_setting(
	    'shareblock_title_font_family',
	    array(
	        'default'     => 'Noto Serif JP',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_title_font_family',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Title font family','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $faces
	    )
	);
	$wp_customize->add_setting(
	    'shareblock_title_font_weight',
	    array(
	        'default'     => '600',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_title_font_weight',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Title font weight','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);	
	$wp_customize->add_setting(
	    'shareblock_title_transform',
	    array(
	        'default'    =>  'none',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'shareblock_title_transform',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Title text transform','shareblock'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'shareblock'),
	        	'capitalize' => esc_html__('Capitalize', 'shareblock'),
	        	'uppercase' => esc_html__('Uppercase', 'shareblock')
	        )
	    )
	);

	$wp_customize->add_setting(
	    'letter_spacing_heading',
	    array(
	        'default'    =>  '0em',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'letter_spacing_heading',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Title letter spacing Ex: 0.03em','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'line_height_heading',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'line_height_heading',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Title line height Ex: 1.2 ','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'shareblock_cat_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);

	$wp_customize->add_control(
	    new shareblock_Customize_Control_Title (
	        $wp_customize,
	        'shareblock_cat_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Category, Meta', 'shareblock' ),
	            'section'		=> 'shareblock_typography_setting',
	            'settings'		=> 'shareblock_cat_settings_title',
	        )
	    )
	);	
	$wp_customize->add_setting(
        'shareblock_cat_font_size',
        array(
            'default'     => '13px',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'shareblock_cat_font_size',
        array(
            'section'   => 'shareblock_typography_setting',
            'label'     => esc_html__('Meta cat font size','shareblock'),
            'type'      => 'select',
            'choices'   => $font_sizes
        )
    );    
	$wp_customize->add_setting(
	    'shareblock_cat_font_weight',
	    array(
	        'default'     => '700',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_cat_font_weight',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Meta cat font weight','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
	$wp_customize->add_setting(
	    'shareblock_cat_transform',
	    array(
	        'default'    =>  'uppercase',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'shareblock_cat_transform',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Meta cat text transform','shareblock'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'shareblock'),
	        	'capitalize' => esc_html__('Capitalize', 'shareblock'),
	        	'uppercase' => esc_html__('Uppercase', 'shareblock')
	        )
	    )
	);      
	$wp_customize->add_setting(
	    'letter_spacing_cat',
	    array(
	        'default'    =>  '0.06em',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'letter_spacing_cat',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Meta cat letter spacing Ex: 0.03em','shareblock'),
	        'type'      => 'text'
	    )
	);
	$wp_customize->add_setting(
        'shareblock_meta_font_size',
        array(
            'default'     => '13px',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'shareblock_meta_font_size',
        array(
            'section'   => 'shareblock_typography_setting',
            'label'     => esc_html__('Meta font size','shareblock'),
            'type'      => 'select',
            'choices'   => $font_sizes
        )
    );
	$wp_customize->add_setting(
	    'shareblock_meta_font_weight',
	    array(
	        'default'     => '400',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'shareblock_meta_font_weight',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Meta font weight','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
 
	$wp_customize->add_setting(
	    'shareblock_meta_transform',
	    array(
	        'default'    =>  'capitalize',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'shareblock_meta_transform',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Meta text transform','shareblock'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'shareblock'),
	        	'capitalize' => esc_html__('Capitalize', 'shareblock'),
	        	'uppercase' => esc_html__('Uppercase', 'shareblock')
	        )
	    )
	);	
	$wp_customize->add_setting(
	    'letter_spacing_meta',
	    array(
	        'default'    =>  '0em',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'letter_spacing_meta',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'label'     => esc_html__('Meta letter spacing Ex: 0.03em','shareblock'),
	        'type'      => 'text'
	    )
	);

	
	$wp_customize->add_setting(
	    'shareblock_ltitle_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new shareblock_Customize_Control_Title (
	        $wp_customize,
	        'shareblock_ltitle_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Large post font size', 'shareblock' ),
	            'section'		=> 'shareblock_typography_setting',
	            'settings'		=> 'shareblock_ltitle_settings_title',
	        )
	    )
	);

$wp_customize->add_setting(
	    'large_post_font_size',
	    array(
	        'default'     => '30px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'large_post_font_size',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'shareblock_gtitle_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new shareblock_Customize_Control_Title (
	        $wp_customize,
	        'shareblock_gtitle_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Grid post font size', 'shareblock' ),
	            'section'		=> 'shareblock_typography_setting',
	            'settings'		=> 'shareblock_gtitle_settings_title',
	        )
	    )
	);

$wp_customize->add_setting(
	    'grid_post_font_size',
	    array(
	        'default'     => '22px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'grid_post_font_size',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'shareblock_lititle_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new shareblock_Customize_Control_Title (
	        $wp_customize,
	        'shareblock_lititle_settings_title',
	        array(
	            'label'      	=> esc_html__( 'List post font size', 'shareblock' ),
	            'section'		=> 'shareblock_typography_setting',
	            'settings'		=> 'shareblock_lititle_settings_title',
	        )
	    )
	);

	$wp_customize->add_setting(
	    'list_post_font_size',
	    array(
	        'default'     => '25px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'list_post_font_size',
	    array(
	        'section'   => 'shareblock_typography_setting',
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);


	/*Button*/
	$wp_customize->add_section(
		    'shareblock_button_setting',
		    array(
		        'title'     => esc_html__('Button & load more Settings', 'shareblock'),
		        'priority'  => 1,
		        'panel' => 'shareblock_theme_options'
		    )
	);

	$wp_customize->add_setting(
	    'shareblock_button_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new shareblock_Customize_Control_Title (
	        $wp_customize,
	        'shareblock_button_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Button Settings', 'shareblock' ),
	            'section'		=> 'shareblock_button_setting',
	            'settings'		=> 'shareblock_button_settings_title',
	        )
	    )
	);
    $wp_customize->add_setting(
	    'shareblock_button_font_size',
	    array(
	        'default'     => '12px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_button_font_size',
	    array(
	        'section'   => 'shareblock_button_setting',
	        'label'     => esc_html__('Button font size','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'shareblock_button_font_weight',
	    array(
	        'default'     => '700',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_button_font_weight',
	    array(
	        'section'   => 'shareblock_button_setting',
	        'label'     => esc_html__('Button font weight','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
	$wp_customize->add_setting(
	    'shareblock_button_transform',
	    array(
	        'default'    =>  'uppercase',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'shareblock_button_transform',
	    array(
	        'section'   => 'shareblock_button_setting',
	        'label'     => esc_html__('Button text transform','shareblock'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'shareblock'),
	        	'capitalize' => esc_html__('Capitalize', 'shareblock'),
	        	'uppercase' => esc_html__('Uppercase', 'shareblock')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'letter_spacing_button',
	    array(
	        'default'    =>  '0.1em',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'letter_spacing_button',
	    array(
	        'section'   => 'shareblock_button_setting',
	        'label'     => esc_html__('Button letter spacing','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'shareblock_loadmore_settings_title',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    new shareblock_Customize_Control_Title (
	        $wp_customize,
	        'shareblock_loadmore_settings_title',
	        array(
	            'label'      	=> esc_html__( 'Load More Settings', 'shareblock' ),
	            'section'		=> 'shareblock_button_setting',
	            'settings'		=> 'shareblock_loadmore_settings_title',
	        )
	    )
	);
    $wp_customize->add_setting(
	    'shareblock_loadmore_font_size',
	    array(
	        'default'     => '12px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_loadmore_font_size',
	    array(
	        'section'   => 'shareblock_button_setting',
	        'label'     => esc_html__('Load More font size','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);
	$wp_customize->add_setting(
	    'shareblock_loadmore_font_weight',
	    array(
	        'default'     => '700',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_loadmore_font_weight',
	    array(
	        'section'   => 'shareblock_button_setting',
	        'label'     => esc_html__('Load More font weight','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $font_weights
	    )
	);
	$wp_customize->add_setting(
	    'shareblock_loadmore_transform',
	    array(
	        'default'    =>  'uppercase',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'shareblock_loadmore_transform',
	    array(
	        'section'   => 'shareblock_button_setting',
	        'label'     => esc_html__('Load More text transform','shareblock'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'shareblock'),
	        	'capitalize' => esc_html__('Capitalize', 'shareblock'),
	        	'uppercase' => esc_html__('Uppercase', 'shareblock')
	        )
	    )
	);
	$wp_customize->add_setting(
	    'letter_spacing_loadmore',
	    array(
	        'default'    =>  '0.1em',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'letter_spacing_loadmore',
	    array(
	        'section'   => 'shareblock_button_setting',
	        'label'     => esc_html__('Load More letter spacing','shareblock'),
	        'type'      => 'text'
	    )
	);

	




	/*Blog & single post*/
	$wp_customize->add_section(
		    'shareblock_blog_single_setting',
		    array(
		        'title'     => esc_html__('Blog & single post Settings', 'shareblock'),
		        'priority'  => 1,
		        'panel' => 'shareblock_theme_options'
		    )
	);

	$wp_customize->add_setting(
	    'single_color',
	    array(
	        'default'     => '',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
    $wp_customize->add_control(
	    new WP_Customize_Color_Control(
	        $wp_customize,
	        'single_color',
	        array(
	            'label'      => esc_html__( 'Single content link color', 'shareblock' ),
	            'section'    => 'shareblock_blog_single_setting',
	            'settings'   => 'single_color'
	        )
	    )
	);

	$wp_customize->add_setting(
	    'single_post_layout_options',
	    array(
	        'default'    =>  's_post_layout_1',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'single_post_layout_options',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Single Post Layout','shareblock'),
	        'type'      => 'select',
	        'choices'	=> array(
	        's_post_layout_1' => esc_html__('Post Layout 1', 'shareblock'),
			's_post_layout_2' => esc_html__('Post Layout 2', 'shareblock'),
			's_post_layout_3' => esc_html__('Post Layout 3', 'shareblock'),
			's_post_layout_4' => esc_html__('Post Layout 4', 'shareblock'),
			's_post_layout_5' => esc_html__('Post Layout 5', 'shareblock'),
			's_post_layout_6' => esc_html__('Post Layout 6', 'shareblock'),
			's_post_layout_7' => esc_html__('Post Layout 7', 'shareblock'),
			's_post_layout_8' => esc_html__('Post Layout 8', 'shareblock')
	        )
	    )
	);

	$wp_customize->add_setting(
	    'shareblock_nav_post_size',
	    array(
	        'default'     => '15px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_nav_post_size',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Post Next/Previous font size','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
	    'shareblock_related_size',
	    array(
	        'default'     => '16px',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'shareblock_related_size',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Related font size','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $font_sizes
	    )
	);

	$wp_customize->add_setting(
		'disable_post_date', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_date',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Disable post date','shareblock'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_post_readtime', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_readtime',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Disable read time','shareblock'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
		'disable_post_view', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_view',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Disable post view','shareblock'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_post_author', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_author',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Disable post author','shareblock'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
		'disable_post_category', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_category',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Disable post category','shareblock'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
		'disable_post_comment_meta', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_comment_meta',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Disable post comment meta','shareblock'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
		'disable_post_tag', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_tag',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Disable post tag','shareblock'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
		'disable_post_share', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_share',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Disable left post share','shareblock'),
	        'type'      => 'checkbox'
	    )
	);

	$wp_customize->add_setting(
		'disable_post_share_footer', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_share_footer',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Disable footer post share','shareblock'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
		'disable_post_nav', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_nav',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Disable post Next/Previous','shareblock'),
	        'type'      => 'checkbox'
	    )
	);
	$wp_customize->add_setting(
		'disable_post_related', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_post_related',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Disable post related','shareblock'),
	        'type'      => 'checkbox'
	    )
	);	

	$wp_customize->add_setting(
		'disable_s_share_fb', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_s_share_fb',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Disable post share Facebook','shareblock'),
	        'type'      => 'checkbox'
	    )
	);	

	$wp_customize->add_setting(
		'disable_s_share_tw', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_s_share_tw',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Disable post share Twitter','shareblock'),
	        'type'      => 'checkbox'
	    )
	);	

	$wp_customize->add_setting(
		'disable_s_share_pin', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_s_share_pin',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Disable post share Pinterest','shareblock'),
	        'type'      => 'checkbox'
	    )
	);	

	$wp_customize->add_setting(
		'disable_s_share_in', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_s_share_in',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Disable post share Linkedin','shareblock'),
	        'type'      => 'checkbox'
	    )
	);	

	$wp_customize->add_setting(
		'disable_s_share_mail', 
		array(
			'default' => false, 
			'transport' => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
	    'disable_s_share_mail',
	    array(
	        'section'   => 'shareblock_blog_single_setting',
	        'label'     => esc_html__('Disable post share Mail','shareblock'),
	        'type'      => 'checkbox'
	    )
	);


	/*Sidebar*/
	$wp_customize->add_section(
		    'shareblock_sidebar_setting',
		    array(
		        'title'     => esc_html__('Sidebar Settings', 'shareblock'),
		        'priority'  => 1,
		        'panel' => 'shareblock_theme_options'
		    )
	);

	$wp_customize->add_setting(
        'disable_widget_block',
        array(
            'default' => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'disable_widget_block',
        array(
            'section'   => 'shareblock_sidebar_setting',
            'label'     => esc_html__('Disable widget block','shareblock'),
            'type'      => 'checkbox'
        )
    );

	$wp_customize->add_setting(
	    'post_sidebar',
	    array(
	        'default'     => 'default',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'post_sidebar',
	    array(
	        'section'   => 'shareblock_sidebar_setting',
	        'label'     => esc_html__('Post sidebar','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $option_sidebar
	    )
	);

	$wp_customize->add_setting(
	    'page_sidebar',
	    array(
	        'default'     => 'default',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'page_sidebar',
	    array(
	        'section'   => 'shareblock_sidebar_setting',
	        'label'     => esc_html__('Page sidebar','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $option_sidebar
	    )
	);

	$wp_customize->add_setting(
	    'category_sidebar',
	    array(
	        'default'     => 'default',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'category_sidebar',
	    array(
	        'section'   => 'shareblock_sidebar_setting',
	        'label'     => esc_html__('Category sidebar','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $option_sidebar
	    )
	);

	$wp_customize->add_setting(
	    'tag_sidebar',
	    array(
	        'default'     => 'default',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'tag_sidebar',
	    array(
	        'section'   => 'shareblock_sidebar_setting',
	        'label'     => esc_html__('Tag sidebar','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $option_sidebar
	    )
	);

	$wp_customize->add_setting(
	    'archive_sidebar',
	    array(
	        'default'     => 'default',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'archive_sidebar',
	    array(
	        'section'   => 'shareblock_sidebar_setting',
	        'label'     => esc_html__('Archive sidebar','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $option_sidebar
	    )
	);

	$wp_customize->add_setting(
	    'author_sidebar',
	    array(
	        'default'     => 'default',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'author_sidebar',
	    array(
	        'section'   => 'shareblock_sidebar_setting',
	        'label'     => esc_html__('Author sidebar','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $option_sidebar
	    )
	);

	$wp_customize->add_setting(
	    'search_sidebar',
	    array(
	        'default'     => 'default',
	        'transport'   => 'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
    $wp_customize->add_control(
	    'search_sidebar',
	    array(
	        'section'   => 'shareblock_sidebar_setting',
	        'label'     => esc_html__('Search sidebar','shareblock'),
	        'type'      => 'select',
	        'choices'	=> $option_sidebar
	    )
	);


	/*Social Header Link*/
	$wp_customize->add_section(
		    'shareblock_social_setting',
		    array(
		        'title'     => esc_html__('Social Link Settings', 'shareblock'),
		        'priority'  => 1,
		        'panel' => 'shareblock_theme_options'
		    )
	);

	$wp_customize->add_setting(
	    'jl_fl_title',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_fl_title',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Social title','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'facebook',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'facebook',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Facebook','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'vk',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'vk',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('VK','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'telegram',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'telegram',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Telegram','shareblock'),
	        'type'      => 'text'
	    )
	);	

	$wp_customize->add_setting(
	    'behance',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'behance',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Behance','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'vimeo',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'vimeo',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Vimeo','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'youtube',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'youtube',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Youtube','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'instagram',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'instagram',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Instagram','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'linkedin',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'linkedin',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Linkedin','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'pinterest',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'pinterest',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Pinterest','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'twitter',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'twitter',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Twitter','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'deviantart',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'deviantart',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Deviantart','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'dribble',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'dribble',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Dribble','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'dropbox',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'dropbox',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Dropbox','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'rss',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'rss',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('RSS','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'skype',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'skype',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Skype','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'stumbleupon',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'stumbleupon',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Stumbleupon','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'wordpress',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'wordpress',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('WordPress','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'yahoo',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'yahoo',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Yahoo','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'sound_cloud',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'sound_cloud',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Sound Cloud','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'spotify_i',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'spotify_i',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('Spotify','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'wechat',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'wechat',
	    array(
	        'section'   => 'shareblock_social_setting',
	        'label'     => esc_html__('wechat','shareblock'),
	        'type'      => 'text'
	    )
	);

	/*Footer*/
	$wp_customize->add_section(
		    'shareblock_footer_setting',
		    array(
		        'title'     => esc_html__('Footer Settings', 'shareblock'),
		        'priority'  => 1,
		        'panel' => 'shareblock_theme_options'
		    )
	);

	$wp_customize->add_setting(
        'footer_bg_color',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_bg_color',
            array(
                'label'      => esc_html__( 'Footer background color', 'shareblock' ),
                'section'    => 'shareblock_footer_setting',
                'settings'   => 'footer_bg_color'
            )
        )
    );

    $wp_customize->add_setting(
        'footer_text_color',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_text_color',
            array(
                'label'      => esc_html__( 'Footer text color', 'shareblock' ),
                'section'    => 'shareblock_footer_setting',
                'settings'   => 'footer_text_color'
            )
        )
    );

    $wp_customize->add_setting(
        'footer_bg_dark',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_bg_dark',
            array(
                'label'      => esc_html__( 'Footer background color dark mode', 'shareblock' ),
                'section'    => 'shareblock_footer_setting',
                'settings'   => 'footer_bg_dark'
            )
        )
    );

    $wp_customize->add_setting(
        'footer_text_dark',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'footer_text_dark',
            array(
                'label'      => esc_html__( 'Footer text color dark mode', 'shareblock' ),
                'section'    => 'shareblock_footer_setting',
                'settings'   => 'footer_text_dark'
            )
        )
    );

	$wp_customize->add_setting(
        'shareblock_footer_opt',
        array(
            'default'     => '',
            'transport'   => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new shareblock_Customize_Control_Title (
            $wp_customize,
            'shareblock_footer_opt',
            array(
                'label'         => esc_html__( 'Footer Options', 'shareblock' ),
                'section'       => 'shareblock_footer_setting',
                'settings'      => 'shareblock_footer_opt',
            )
        )
    );

	$wp_customize->add_setting(
	    'footer_columns',
	    array(
	        'default'    =>  'footer4col',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'footer_columns',
	    array(
	        'section'   => 'shareblock_footer_setting',
	        'label'     => esc_html__('Footer columns','shareblock'),
	        'type'      => 'select',
	        'choices'	=> array(
	        'footer4col' => esc_html__('Footer 4 columns', 'shareblock'),
			'footer3col' => esc_html__('Footer 3 columns', 'shareblock'),
			'footer2col' => esc_html__('Footer 2 columns', 'shareblock'),
			'footer1col' => esc_html__('Footer 1 columns', 'shareblock'),
			'footer0col' => esc_html__('No Footer', 'shareblock')
	        )
	    )
	);

	$wp_customize->add_setting(
	    'sub_footer',
	    array(
	        'default'    =>  'sub_footer0',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'sub_footer',
	    array(
	        'section'   => 'shareblock_footer_setting',
	        'label'     => esc_html__('Sub footer style','shareblock'),
	        'type'      => 'select',
	        'choices'	=> array(
	        'sub_footer1' => esc_html__('Style 1', 'shareblock'),
			'sub_footer2' => esc_html__('Style 2', 'shareblock'),
			'sub_footer0' => esc_html__('Disable', 'shareblock')
	        )
	    )
	);

	$wp_customize->add_setting(
	    'jl_copyright',
	    array(
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'wp_kses_post',	        
	    )
	);
	$wp_customize->add_control(
	    'jl_copyright',
	    array(
	        'section'   => 'shareblock_footer_setting',
	        'label'     => esc_html__('Footer copyright','shareblock'),
	        'type'      => 'textarea'
	    )
	);	


	/*Cookie*/
	$wp_customize->add_section(
		    'shareblock_cookie_setting',
		    array(
		        'title'     => esc_html__('Cookie Settings', 'shareblock'),
		        'priority'  => 1,
		        'panel' => 'shareblock_theme_options'
		    )
	);

	$wp_customize->add_setting(
        'jl_cookie_enable', 
        array(
            'default' => false, 
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jl_cookie_enable',
        array(
            'section'   => 'shareblock_cookie_setting',
            'label'     => esc_html__('Enable Cookie','shareblock'),
            'type'      => 'checkbox'
        )
    );

	$wp_customize->add_setting(
	    'jl_cookie_dec',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'wp_kses_post',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_dec',
	    array(
	        'section'   => 'shareblock_cookie_setting',
	        'label'     => esc_html__('Cookie description','shareblock'),
	        'type'      => 'textarea'
	    )
	);	
	$wp_customize->add_setting(
	    'jl_cookie_btn',
	    array(
	        'default'    =>  'Accept',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_btn',
	    array(
	        'section'   => 'shareblock_cookie_setting',
	        'label'     => esc_html__('Cookie button','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_cookie_dec_size',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_dec_size',
	    array(
	        'section'   => 'shareblock_cookie_setting',
	        'label'     => esc_html__('Cookie font size Ex: 12px;','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_cookie_btn_size',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_btn_size',
	    array(
	        'section'   => 'shareblock_cookie_setting',
	        'label'     => esc_html__('Cookie button font size Ex: 12px;','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_cookie_btn_space',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_btn_space',
	    array(
	        'section'   => 'shareblock_cookie_setting',
	        'label'     => esc_html__('Cookie button letter spacing Ex: 1px;','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_cookie_btn_tranform',
	    array(
	        'default'    =>  'capitalize',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_cookie_btn_tranform',
	    array(
	        'section'   => 'shareblock_cookie_setting',
	        'label'     => esc_html__('Cookie button transform','shareblock'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'shareblock'),
	        	'capitalize' => esc_html__('Capitalize', 'shareblock'),
	        	'uppercase' => esc_html__('Uppercase', 'shareblock')
	        )
	    )
	);

	/*Top Bar*/
	$wp_customize->add_section(
		    'shareblock_topbar_setting',
		    array(
		        'title'     => esc_html__('Top Bar Settings', 'shareblock'),
		        'priority'  => 1,
		        'panel' => 'shareblock_theme_options'
		    )
	);

	$wp_customize->add_setting(
        'jl_topbar_enable', 
        array(
            'default' => false, 
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        'jl_topbar_enable',
        array(
            'section'   => 'shareblock_topbar_setting',
            'label'     => esc_html__('Enable top bar','shareblock'),
            'type'      => 'checkbox'
        )
    );

	$wp_customize->add_setting(
	    'jl_topbar_dec',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'wp_kses_post',
	    )
	);
	$wp_customize->add_control(
	    'jl_topbar_dec',
	    array(
	        'section'   => 'shareblock_topbar_setting',
	        'label'     => esc_html__('Top bar description','shareblock'),
	        'type'      => 'textarea'
	    )
	);	
	$wp_customize->add_setting(
	    'jl_topbar_btn',
	    array(
	        'default'    =>  'Learn More',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_topbar_btn',
	    array(
	        'section'   => 'shareblock_topbar_setting',
	        'label'     => esc_html__('Top bar button','shareblock'),
	        'type'      => 'text'
	    )
	);
	$wp_customize->add_setting(
	    'jl_topbar_btn_url',
	    array(
	        'default'    =>  '#',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_topbar_btn_url',
	    array(
	        'section'   => 'shareblock_topbar_setting',
	        'label'     => esc_html__('Top bar button url','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_topbar_dec_size',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_topbar_dec_size',
	    array(
	        'section'   => 'shareblock_topbar_setting',
	        'label'     => esc_html__('Topbar font size Ex: 12px;','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_topbar_btn_size',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_topbar_btn_size',
	    array(
	        'section'   => 'shareblock_topbar_setting',
	        'label'     => esc_html__('Topbar button font size Ex: 12px;','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_topbar_btn_space',
	    array(
	        'default'    =>  '',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_topbar_btn_space',
	    array(
	        'section'   => 'shareblock_topbar_setting',
	        'label'     => esc_html__('Topbar button letter spacing Ex: 1px;','shareblock'),
	        'type'      => 'text'
	    )
	);

	$wp_customize->add_setting(
	    'jl_topbar_btn_tranform',
	    array(
	        'default'    =>  'capitalize',
	        'transport'  =>  'refresh',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control(
	    'jl_topbar_btn_tranform',
	    array(
	        'section'   => 'shareblock_topbar_setting',
	        'label'     => esc_html__('Topbar button transform','shareblock'),
	        'type'      => 'select',
	        'choices' 	=> array(
	        	'none' => esc_html__('None', 'shareblock'),
	        	'capitalize' => esc_html__('Capitalize', 'shareblock'),
	        	'uppercase' => esc_html__('Uppercase', 'shareblock')
	        )
	    )
	);

	/*Optimize / SEO*/
	$wp_customize->add_section(
		'shareblock_optimize_setting',
		array(
			'title'     => esc_html__('Optimize / SEO Settings', 'shareblock'),
			'priority'  => 1,
			'panel' => 'shareblock_theme_options'
		)
);

$wp_customize->add_setting(
	'jl_opt_google_font',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'jl_opt_google_font',
	array(
		'section'   => 'shareblock_optimize_setting',
		'label'     => esc_html__('Preload Google Fonts','shareblock'),
		'type'      => 'checkbox'
	)
);

$wp_customize->add_setting(
	'jl_opt_font_icons',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'jl_opt_font_icons',
	array(
		'section'   => 'shareblock_optimize_setting',
		'label'     => esc_html__('Preload Font Icon','shareblock'),
		'type'      => 'checkbox'
	)
);

$wp_customize->add_setting(
	'jl_opt_dashicons',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'jl_opt_dashicons',
	array(
		'section'   => 'shareblock_optimize_setting',
		'label'     => esc_html__('Disable Dashicons','shareblock'),
		'type'      => 'checkbox'
	)
);

$wp_customize->add_setting(
	'jl_opt_polyfill',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'jl_opt_polyfill',
	array(
		'section'   => 'shareblock_optimize_setting',
		'label'     => esc_html__('Disable Polyfill','shareblock'),
		'type'      => 'checkbox'
	)
);

$wp_customize->add_setting(
	'jl_opt_woo_block',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'jl_opt_woo_block',
	array(
		'section'   => 'shareblock_optimize_setting',
		'label'     => esc_html__('Disable WooCommerce Block Style','shareblock'),
		'type'      => 'checkbox'
	)
);

$wp_customize->add_setting(
	'jl_opt_gutenberg',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'jl_opt_gutenberg',
	array(
		'section'   => 'shareblock_optimize_setting',
		'label'     => esc_html__('Disable Gutenberg Style','shareblock'),
		'type'      => 'checkbox'
	)
);

$wp_customize->add_setting(
	'jl_opt_lazy_img',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'jl_opt_lazy_img',
	array(
		'section'   => 'shareblock_optimize_setting',
		'label'     => esc_html__('Disable lazy load images','shareblock'),
		'type'      => 'checkbox'
	)
);

$wp_customize->add_setting(
	'shareblock_seo_sec_options',
	array(
		'default'     => '',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new shareblock_Customize_Control_Title (
		$wp_customize,
		'shareblock_seo_sec_options',
		array(
			'label'         => esc_html__( 'SEO', 'shareblock' ),
			'section'       => 'shareblock_optimize_setting',
			'settings'      => 'shareblock_seo_sec_options',
		)
	)
);

$wp_customize->add_setting(
	'jl_opt_seo',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'jl_opt_seo',
	array(
		'section'   => 'shareblock_optimize_setting',
		'label'     => esc_html__('Disable Open Graph Meta','shareblock'),
		'type'      => 'checkbox'
	)
);

$wp_customize->add_setting(
	'jl_seo_twiter_name',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'jl_seo_twiter_name',
	array(
		'section'   => 'shareblock_optimize_setting',
		'label'     => esc_html__('SEO Twiter creator name','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'jl_seo_twiter_label',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'jl_seo_twiter_label',
	array(
		'section'   => 'shareblock_optimize_setting',
		'label'     => esc_html__('SEO Twiter label','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'jl_seo_fb_app_id',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'jl_seo_fb_app_id',
	array(
		'section'   => 'shareblock_optimize_setting',
		'label'     => esc_html__('Facebook APP ID','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_seo_img',
	array(
	'default' 			=> '',
	'transport'   		=> 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
		$wp_customize,
		'shareblock_seo_img',
		array(
		'label'    => esc_html__( 'Fallback Open Graph Image', 'shareblock' ),
		'section'  => 'shareblock_optimize_setting',
		'settings' => 'shareblock_seo_img'
	)));

	/*Theme string*/
$wp_customize->add_section(
	'shareblock_string_setting',
	array(
		'title'     => esc_html__('Theme Strings', 'shareblock'),
		'priority'  => 1,
		'panel' => 'shareblock_theme_options'
	)
);

$wp_customize->add_setting(
	'shareblock_s_by',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_by',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('By','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_mins_read',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_mins_read',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Mins read','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_views',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_views',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Views','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_shares',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_shares',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Shares','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_share_on_facebook',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_share_on_facebook',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Share on Facebook','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_share_on_twitter',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_share_on_twitter',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Share on Twitter','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_previous_post',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_previous_post',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Previous post','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_next_post',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_next_post',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Next post','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_related_articles',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_related_articles',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Related Articles','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_older_comments',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_older_comments',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('« Older Comments','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_newer_comments',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_newer_comments',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Newer Comments »','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_one_ping',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_one_ping',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('One Ping','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_one_comment',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_one_comment',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('One Comment','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_comments',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_comments',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Comments','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_pings_trackbacks',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_pings_trackbacks',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Pings & Trackbacks','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_fullname',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_fullname',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Full Name','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_email_address',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_email_address',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Email Address','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_web_url',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_web_url',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Web URL','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_comment',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_comment',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Comment','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_summary',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_summary',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Summary','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_the_pros',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_the_pros',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('The Pros','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_the_cons',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_the_cons',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('The Cons','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_search',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_search',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Search ...','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_search_for',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_search_for',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Search for:','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_no_result_found',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_no_result_found',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('No result found','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_no_result_found_des',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_no_result_found_des',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('It looks like nothing was found here. Please try it again.','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_articles',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_articles',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Articles','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_404',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_404',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('404','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_404_desc',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_404_desc',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('OOOOOPS!! The page you are looking for not exist!','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_back_to_home',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_back_to_home',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('Back to Home','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_load_more',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_load_more',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('load more','shareblock'),
		'type'      => 'text'
	)
);

$wp_customize->add_setting(
	'shareblock_s_no_post_to_load',
	array(
		'default'    =>  '',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'shareblock_s_no_post_to_load',
	array(
		'section'   => 'shareblock_string_setting',
		'label'     => esc_html__('No post to load','shareblock'),
		'type'      => 'text'
	)
);

	
$wp_customize->remove_section( 'colors' );
$wp_customize->remove_section( 'background_image' );
}
add_action( 'customize_register', 'shareblock_register_theme_customizer', 110 );