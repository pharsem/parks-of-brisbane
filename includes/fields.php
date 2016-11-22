<?php

// helper methods to generate input fields

	function label($name, $label)
	{
		echo "<label for=\"$name\">$label</label>";
	}

	function errorLabel($errors, $name)
	{
		echo "<span id=\"$name\" class=\"error\">";

		if (isset($errors[$name]))
			echo $errors[$name];
		echo '</span>';
	}

	function posted_value($name)
	{
		if(isset($_POST[$name]))
			return htmlspecialchars($_POST[$name]);
		else
			return '';
	}

	function input_field($errors, $name, $label)
	{
		echo '<div class="required_field">';
		$value = posted_value($name);
		echo "<input type=\"text\" id=\"$name\" name=\"$name\" placeholder=\"$label\" value=\"$value\"/>";
		errorLabel($errors, $name);
		echo '</div>';
	}

    function password_field($errors, $name, $label)
    {
        echo '<div class="required_field">';
        echo "<input type=\"password\" id=\"$name\" name=\"$name\" placeholder=\"$label\"/>";
		errorLabel($errors, $name);
		echo '</div>';
    }
	
	function select($name, $values)
	{
		echo "<select id=\"$name\" name=\"$name\">";
		foreach ($values as $value => $display)
		{
			$selected = ($value===posted_value($name))?'selected="selected"':'';
			echo "<option $selected value=\"$display\">$display</option>";
		}
		echo '</select>';
	}	
	
	function date_field($errors, $name, $label)
	{
		echo '<div class="required_field date">';
		label($name, $label);
		
		$year = date('Y');
		$days = array_merge(array('' => 'Day'), range(1, 31));
		$years = array_merge(array('' => 'Year'), range($year-5, $year-100));
		$months = array('' => 'Month', 1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 =>'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
		
		select("{$name}_day", $days);
		select("{$name}_month", $months);
		select("{$name}_year", $years);	
		
		errorLabel($errors, $name);
		echo '</div>';		
	}
?>