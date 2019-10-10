<?php

/*
 * Plugin Name: Metafield test
	Plugin URL:
	Description: Demo of Plugin Custom Meta Option
	Version: 1.0
	Author: osman forhad
	Author URI: https://osmanforhad.net
	License: GPLv2 or later
	Text Domain:testmeta
	Domain Path: /languages/
 * */

class MetaFieldtest {

	public function __construct() {

		add_action( 'plugin_loaded', array( $this, 'metatest_load_text_domain' ) );

		add_action( 'add_meta_boxes', array( $this, 'cbx_add_custom_box' ) );
		add_action( 'save_post', array( $this, 'cbx_save_data' ) );

	}//end constructor

	/*load text domain*/
	public function metatest_load_text_domain() {

		load_plugin_textdomain(
			'testmeta',
			'false',
			dirname( __FILE__ ) . "/languages"
		);

	}//end load text domain

	/*adding meta box*/
	public function cbx_add_custom_box() {

		$screens = [ 'post', 'page' ];

		foreach ( $screens as $screen ) {

			add_meta_box(
				'cbx_box_id',
				'Meta Box Test as array',
				array( $this, 'cbx_custom_meta_field_setup_cb' ),
				$screen
			);
		}

	}//end meta box

	/*meta box render cb*/
	public function cbx_custom_meta_field_setup_cb( $post ) {

		/*retrive data from db table*/
		$output = get_post_meta( $post->ID, '_cbxmetaArray', true );

		/*end retrive data from db table*/

		$fields = array(

			/*text field*/
			array(
				'label'       => esc_html__( 'Text Field', 'testmeta' ),
				'name'        => 'meta_text',
				'id'          => 'meta_textfield',
				'type'        => 'text',
				'value'       => $output['meta_text'],
				'placeholder' => esc_html__( 'Text Field', 'testmeta' ),
				'option_name' => 'testmeta'
			),//end text field

			/*email field*/
			array(
				'label'       => esc_html__( 'Email Field', 'testmeta' ),
				'name'        => 'meta_email',
				'id'          => 'meta_emailfield',
				'value'       => $output['meta_email'],
				'type'        => 'text',
				'placeholder' => esc_html__( 'Email Field', 'testmeta' ),
				'option_name' => 'testmeta'
			),//end email field

			/*password field*/
			array(
				'label'       => esc_html__( 'Password Field', 'testmeta' ),
				'name'        => 'meta_pass',
				'id'          => 'meta_passlfield',
				'value'       => $output['meta_pass'],
				'type'        => 'password',
				'placeholder' => esc_html__( 'Password Field', 'testmeta' ),
				'option_name' => 'testmeta'
			),//end password field

			/*number field*/
			array(
				'label'       => esc_html__( 'Number Field', 'testmeta' ),
				'name'        => 'meta_number',
				'id'          => 'meta_number',
				'type'        => 'number',
				'value'       => $output['meta_number'],
				'placeholder' => esc_html__( 'Number Field', 'testmeta' ),
				'min'         => '1',
				'max'         => '5',
				'option_name' => 'testmeta'
			),//end number field

			/*url field*/
			array(
				'label'       => esc_html__( 'Url Field', 'testmeta' ),
				'name'        => 'meta_url',
				'id'          => 'meta_url',
				'type'        => 'url',
				'value'       => $output['meta_url'],
				'placeholder' => esc_html__( 'Url Field', 'testmeta' ),
				'option_name' => 'testmeta'
			),//end url field

			/*textarea field*/
			array(
				'label'       => esc_html__( 'Textarea', 'testmeta' ),
				'name'        => 'meta_textarea',
				'id'          => 'meta_textarea',
				'type'        => 'textarea',
				'placeholder' => esc_html__( 'Message', 'testmeta' ),
				'option_name' => 'testmeta'
			),//end textarea field

			//multiple checkbox field
			array(
				'label'       => esc_html__( 'Multiple Checkbox', 'testmeta' ),
				'name'        => 'meta_multicheck',
				'id'          => 'meta_multicheck',
				'type'        => 'checkbox',
				/*check option */
				'countries'   => array(
					esc_html__( 'Bangladesh', 'testmeta' ),
					esc_html__( 'India', 'testmeta' ),
					esc_html__( 'Pakistan', 'testmeta' ),
					esc_html__( 'Nepal', 'testmeta' ),
					esc_html__( 'Bhutan', 'testmeta' ),
					esc_html__( 'Srilanka', 'testmeta' )
				),//end check option
				'option_name' => 'testmeta'
			),//end multiple check box

			/*radio button*/
			array(
				'label'       => esc_html__( 'Radio', 'testmeta' ),
				'name'        => 'meta_radio',
				'id'          => 'meta_radio',
				'type'        => 'radio',
				/*radio option*/
				'conditions'  => array(
					esc_html__( 'Yes', 'testmeta' ),
					esc_html__( 'No', 'testmeta' )
				),//end radio option
				'option_name' => 'testmeta'
			),//end radio button

			/*select field*/
			array(
				'label'       => esc_html__( 'Select', 'testmeta' ),
				'name'        => 'cbxmeta_select',
				'id'          => 'cbxmeta_select',
				'type'        => 'select',
				/*select option*/
				'countries'   => array(
					esc_html__( 'India', 'testmeta' ),
					esc_html__( 'Usa', 'testmeta' ),
					esc_html__( 'Uk', 'testmeta' ),
					esc_html__( 'Canada', 'testmeta' ),
					esc_html__( 'Brazil', 'testmeta' )
				),//end select option
				'option_name' => 'testmeta'
			),//end select field

			/*multiple select field*/
			array(
				'label'       => esc_html__( 'Multi Select', 'testmeta' ),
				'name'        => 'multi_selectmeta',
				'id'          => 'multi_selectmeta',
				'type'        => 'multiple',
				/*multiple select option*/
				'countries'   => array(
					esc_html__( 'Japan', 'testmeta' ),
					esc_html__( 'China', 'testmeta' ),
					esc_html__( 'Korea', 'testmeta' ),
					esc_html__( 'France', 'testmeta' ),
					esc_html__( 'Bangladesh', 'testmeta' )
				),//end multiple select option
				'option_name' => 'testmeta'
			),//end multiple select field

		);


		/*looping for array listed fields*/
		foreach ( $fields as $field ) {

			/*checked for  displayed  value as output */
			$value = isset( $output[ $field['id'] ] ) ? $output[ $field['id'] ] : '';

			/*save data call back function*/
			array( $this, 'cbx_save_data' );

			?>

			<?php

			/*using switch case*/

			switch ( $field['type'] ) {

				/*render html text fields*/
				case 'text':

					printf( '<p>

           <label for="cbx_label">%4$s &nbsp;&nbsp;&nbsp;</label>
               <input name="%1$s" id="%2$s" placeholder="%3$s" value="%5$s"/>
               <hr>
								   </p>',
								   
						$field['name'],//imagine index 1
						$field['id'],//imagine index 2
						$field['placeholder'],//imagine index 3
						$field['label'],//imagine index 4
						$field['value']//imagine index 5
					);
					break;
				/*end render html text fields*/

				/*render html email fields*/
				case 'email':

					printf( '<p>
           <label for="cbx_label">%4$s &nbsp;&nbsp;&nbsp;</label>
               <input name="%1$s" id="%2$s" placeholder="%3$s" value="%5$s"/>
               <hr>
                                   </p>',
						$field['name'],//imagine index 1
						$field['id'],//imagine index 2
						$field['placeholder'],//imagine index 3
						$field['label'],//imagine index 4
						$field['value']//imagine index 5
					);
					break;
				/*end render html email fields*/

				/*render html password fields*/
				case 'password':

					printf( '<p>
         <label for="cbx_label">%4$s &nbsp;&nbsp;&nbsp;</label>
               <input name="%1$s" id="%2$s" placeholder="%3$s" value="%5$s"/>
               <hr>
                                   </p>',
						$field['name'],//imagine index 1
						$field['id'],//imagine index 2
						$field['placeholder'],//imagine index 3
						$field['label'],//imagine index 4
						$field['value']//imagine index 5
					);
					break;
				/*end render html password fields*/

				/*render html Number fields*/
				case 'number':

					printf( '<p>
        <label for="cbx_label">%4$s &nbsp;&nbsp;&nbsp;</label>
               <input name="%1$s" id="%2$s" placeholder="%3$s" value="%5$s"/>
               <hr>
                                   </p>',
						$field['name'],//imagine index 1
						$field['id'],//imagine index 2
						$field['placeholder'],//imagine index 3
						$field['label'],//imagine index 4
						$field['value']//imagine index 5
					);
					break;
				/*end render html Number fields*/

				/*render html Url fields*/
				case 'url':

					printf( '<p>
       <label for="cbx_label">%4$s &nbsp;&nbsp;&nbsp;</label>
               <input name="%1$s" id="%2$s" placeholder="%3$s" value="%5$s"/>
               <hr>
                                   </p>',
						$field['name'],//imagine index 1
						$field['id'],//imagine index 2
						$field['placeholder'],//imagine index 3
						$field['label'],//imagine index 4
						$field['value']//imagine index 5
					);
					break;
				/*end render html Url fields*/

				/*render textarea field*/
				case 'textarea':

					printf( '<p>
                             <label for="cbx_label">%4$s &nbsp;&nbsp;&nbsp;</label>
                    <textarea name="%1$s" id="%2$s" placeholder="%3$s" rows="5" cols="50">%5$s</textarea>
                     <hr>
                     </p>',
						$field['name'],//imagine index 1
						$field['id'],//imagine index 2
						$field['placeholder'],//imagine index 3
						$field['label'],//imagine index 4
						$value//imagine index 5
					);
					break;//end render textarea

				/*render Multi check box field*/
				case 'checkbox':

					echo "<p>";

					/*label for multi check box*/
					printf( '<label for="cbx_label">%1$s &nbsp;&nbsp;&nbsp;</label>',
						$field['label']
					);

					//explode html check option
					$countries = $field['countries'];

					/*foreach loop for check option*/
					foreach ( $countries as $key => $country ) {
						$checked = '';

						/*check condition for value is in arary listed*/
						if ( is_array( $value ) && in_array( $key, $value ) ) {
							//for checked mark
							$checked = 'checked';
						}

						/*for html field*/
						printf( '
        <input id="%2$s" name="%1$s[%6$s]" type="%3$s" value="%4$s" %5$s />%6$s',
							$field['name'], //imagine index 1
							$field['id'], //imagine index 2
							$field['type'],//imagine index 3
							$key,//imagine index 4
							$checked,//imagine index5
							$country//imagine index 6
						//$value//imagine index 7
						);

					} /*foreach loop for check option*/

					echo "</p> <hr>";
					break; /*render Multi check box field*/

				/*Render radio check*/
				case 'radio':

					echo "<p>";

					/*label for radio check box*/
					printf( '<label for="cbx_label">%1$s &nbsp;&nbsp;&nbsp;</label>',
						$field['label']
					);

					//explode html check option
					$conditions = $field['conditions'];

					/*foreach loop for radio option*/
					foreach ( $conditions as $condition ) {
						$selected = '';

					$radio = 	isset($value['meta_radio']) ? $value['meta_radio']:'';
						/*check condition for geting specific value*/
						if ( $radio == $condition ) {
							/*for radio check*/
							$selected = 'checked';
						}

						/*for html field display*/
						printf( '<input id="%2$s" name="%1$s[%2$s]" type="%3$s" value="%4$s" %5$s />%6$s ',
							$field['name'],//imagine index 1
							$field['id'],//imagine index 2
							$field['type'],//imagine index 3
							$condition,//imagine index 4
							$selected,//imagine index 5
							$condition//imagine index 6

						);

					}/*end foreach loop for check option*/

					echo "</p> <hr>";
					break;//end render radio field

				/*Select filed*/
				case 'select':
					echo "<p>";

					/*label for select field*/
					printf( '<label for="cbx_label">%1$s &nbsp;&nbsp;&nbsp;</label>',
						$field['label']
					);

					/*render html select field*/
					printf( '<select id="%2$s" type="%3$s" name="%1$s">',
						$field['name'],//imagine index 1
						$field['id'],//imagine index 2
						$field['type']//imagine index 3
					);

					//explode html select option from array
					$countries = $field['countries'];

					/*foreach loop for select option*/
					foreach ( $countries as $country ) {
						$selected = '';

						/*condition check for output data as selected*/
						if ( $value == $country ) {
							//for select confirm
							$selected = 'selected';
						}

						/*render selected value*/
						printf( '<option value="%1$s" %2$s >%3$s</option>',
							$country,//imagine index 1
							$selected,//imagine index 2
							$country//imagine index 3
						);
					} //end foreach loop for select option

					printf( '</select> <hr>' ); //end select

				echo "</p>";

					break;//end render select field

				/*Multiple select*/
				case 'multiple':

					echo "<p>";

					/*label for Multi Select*/
					printf( '<label for="cbx_label">%1$s &nbsp;&nbsp;&nbsp;</label>',
						$field['label']
					);

					/*render html select field*/
					printf( '<select id="%2$s" name="%1$s[]" multiple>',

					$field['name'],
					$field['id']

					);

					//explode html select option from array
					$countries = $field['countries'];

					/*foreach loop for select option*/
					foreach ( $countries as $key => $country ) {
						$selected = '';

						/*condition check for output data as selected*/
						if ( is_array( $value ) && in_array( $key, $value ) ) {
							//for selected mark
							$selected = 'selected';
						}

						/*render all selected value*/
						printf( '<option value="%1$s" %2$s >%3$s</option>',
							$key,
							$selected,
							$country
						); /*end render all selected value*/
					} /*end foreach loop for select option*/

					//echo "</select>";

				printf('</select>');//end select

					echo "</p>";

					break;//end multiple select

				/*default */
				default:
					printf( '<input name="%1$s[%2$s]" id="%1$s-%2$s" type="%3$s" placeholder="%4$s" value="%5$s"/>',
						$field['name'],
						$field['id'],
						$field['type'],
						isset( $field['placeholder'] ) ? $field['placeholder'] : '',
						$value
					);//end default


			} /*end switch case*/

		}//end foreach loop for array listed field


	}//end meta box render cb

	/*save data into db table*/
	public function cbx_save_data( $post_id ) {

		/*condition check for every field*/
		
			$text_field = isset( $_POST['meta_text'] ) ? $_POST['meta_text'] :'';
			$emial_field = isset( $_POST['meta_email'] ) ? $_POST['meta_email'] :'';
			$pass_field =  isset( $_POST['meta_pass'] )  ? $_POST['meta_pass'] :'';
			$number_field =  isset( $_POST['meta_number'] ) ? $_POST['meta_number'] :'';
			$url_field = isset( $_POST['meta_url'] ) ? $_POST['meta_url'] :'';
			$textarea_field =  isset( $_POST['meta_textarea'] ) ? $_POST['meta_textarea'] :'';
			$multicheck_field =  isset( $_POST['meta_multicheck'] ) ? $_POST['meta_multicheck'] : array();
			$radio_field = isset( $_POST['meta_radio'] ) ? $_POST['meta_radio'] : '';
			$select_field =  isset( $_POST['cbxmeta_select'] ) ? $_POST['cbxmeta_select'] :'';
			$multiselect_field = isset( $_POST['multi_selectmeta'] ) ? $_POST['multi_selectmeta'] :array();
		

			/*catch data as array*/
			$inputData                     = array();
			$inputData['meta_text']        = $text_field;
			$inputData['meta_email']       = $emial_field ;
			$inputData['meta_pass']        = $pass_field;
			$inputData['meta_number']      = $number_field;
			$inputData['meta_url']         = $url_field;
			$inputData['meta_textarea']    = $textarea_field;
			$inputData['meta_multicheck']  = $multicheck_field;
			$inputData['meta_radio']       = $radio_field;
			$inputData['cbxmeta_select']   = $select_field;
			$inputData['multi_selectmeta'] = $multicheck_field;

			/*submit data into db table*/
			update_post_meta( $post_id, '_cbxmetaArray', $inputData );

		

//write_log('cbx_save_data');

	}//end save data method

}//end of the class

//initiate the class
new MetaFieldtest();