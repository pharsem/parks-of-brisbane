<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>King Edward Park</title>

    <?php include 'includes/imports.php'; ?>

</head>

<body>

<div id="container">

<div id="header">
    <a href="index.php"><div id="logo_background"></div></a>
    <div id="logo_text"><a href="index.php">Parks of Brisbane</a></div>
   	<div id='navbar'>
        <ul>
           <li><a href='index.php'><span>Home</span></a></li>
           
           <li>
           <a id="search-trigger" href='#'>
           		<span>Search</span>
           </a>
           <div id="search-content">
                <form action="search-result.php">
                  <fieldset class="inputs">
                    <input id="search" type="text" name="Search" placeholder="Suburb, postcode or name of park">
                    <label>
                  		<a href="search.php">Advanced search</a>
                  	</label>
                  </fieldset>
                  <fieldset id="search-button">
                    <input type="submit" class="submit" value="Search">
                  </fieldset>
                </form>
              </div>
           
           </li>
           
           <li>
           	<a id="login-trigger" href='#'>
            	<span>Register/Log in</span>
            </a>
           <div id="login-content">
                <form>
                  <fieldset class="inputs">
                    <input id="username" type="email" name="Email" placeholder="Email address" required>   
                    <input id="password" type="password" name="Password" placeholder="Password" required>
                  <label>
                  	<a href="register.php">Not a member yet? Register now!</a>
                  </label>
                  </fieldset>
                  
                  <fieldset id="login-button">
                    <input type="submit" class="submit" value="Log in">
                  </fieldset>
                  
                </form>
              </div>                     
            </li>
            
           	<li><a href='#'><span>About</span></a></li>
        </ul>
	</div>
</div>

<div id="content">
	<div id="item-description">
   	  <h1>King Edward Park</h1>
      <div id="map-single-item"></div>
        <p>
            Rating: &#9733;&#9733;&#9733;&#9734;&#9734;<br />
            Suburb: Brisbane City<br />
            Street: Turbot St.
        </p>
    
          <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam pulvinar   lobortis bibendum. Ut at accumsan mauris. Vivamus laoreet consectetur   volutpat. Maecenas vel neque feugiat, aliquet leo sit amet, tempor   justo. Phasellus ac risus fermentum, vehicula dui id, ultricies est. Ut   mauris massa, varius non justo id, bibendum mattis ante. Etiam suscipit   nisl id odio rhoncus, volutpat imperdiet urna fermentum. Nullam vitae   diam euismod, tincidunt ipsum ut, fermentum ligula. Curabitur   ullamcorper purus ligula, sit amet posuere ante tempus et. Vestibulum   varius congue gravida. Nullam adipiscing diam quis sapien laoreet   interdum. Ut pretium metus eu turpis dapibus, nec imperdiet justo   faucibus. </p>

    </div>
    
	<div>
    <h1>User reviews</h1>
    	<div class="single-review">
        	<h2>Nullam vitae diam</h2>
            <p>
                User: <a href="#" title="View other reviews by lipsum1">lipsum1</a> <br />
                Rating: &#9733;&#9733;&#9733;&#9734;&#9734;
            </p>
            <p>Duis accumsan condimentum arcu, et suscipit libero interdum eu. Aliquam dignissim faucibus ullamcorper. Sed luctus magna quis elit adipiscing auctor. Nunc at metus tortor. Aenean id nisl ipsum. Integer tortor eros, hendrerit sit amet lacus auctor, blandit eleifend ligula. Curabitur ultrices urna augue, vel aliquam ante dapibus a. Morbi fringilla commodo lacus, a volutpat augue sagittis ut. Nam sollicitudin risus ligula, eget elementum nibh tincidunt semper. Donec facilisis dolor a ullamcorper interdum. Pellentesque volutpat velit elit, ac tempus augue blandit non. Pellentesque posuere dictum dui, nec blandit justo euismod a. </p>
        </div>
        
        <div class="single-review">
        	<h2>Pellentesque posuere dictum dui</h2>
            <p>
                User: <a href="#" title="View other reviews by lipsum2">lipsum2</a> <br />
                Rating: &#9733;&#9733;&#9734;&#9734;&#9734;
            </p>
            <p>Duis accumsan condimentum arcu, et suscipit libero interdum eu. Aliquam dignissim faucibus ullamcorper. Sed luctus magna quis elit adipiscing auctor. Nunc at metus tortor. Aenean id nisl ipsum. Integer tortor eros, hendrerit sit amet lacus auctor, blandit eleifend ligula. Curabitur ultrices urna augue, vel aliquam ante dapibus a. Morbi fringilla commodo lacus, a volutpat augue sagittis ut. Nam sollicitudin risus ligula, eget elementum nibh tincidunt semper. Donec facilisis dolor a ullamcorper interdum. Pellentesque volutpat velit elit, ac tempus augue blandit non. Pellentesque posuere dictum dui, nec blandit justo euismod a. </p>
        </div>
        
        <div class="single-review">
        	<h2>Aenean id nisl ipsum</h2>
            <p>
                User: <a href="#" title="View other reviews by lipsum3">lipsum3</a> <br />
                Rating: &#9733;&#9733;&#9733;&#9733;&#9733;
            </p>
            <p>Duis accumsan condimentum arcu, et suscipit libero interdum eu. Aliquam dignissim faucibus ullamcorper. Sed luctus magna quis elit adipiscing auctor. Nunc at metus tortor. Aenean id nisl ipsum. Integer tortor eros, hendrerit sit amet lacus auctor, blandit eleifend ligula. Curabitur ultrices urna augue, vel aliquam ante dapibus a. Morbi fringilla commodo lacus, a volutpat augue sagittis ut. Nam sollicitudin risus ligula, eget elementum nibh tincidunt semper. Donec facilisis dolor a ullamcorper interdum. Pellentesque volutpat velit elit, ac tempus augue blandit non. Pellentesque posuere dictum dui, nec blandit justo euismod a. </p>
        </div>
        
    </div>
    
    <div class="clear"></div>
</div>

<div id="push"></div>

<div id="footer">
    <div id="footerText">
        &copy; Petter Harsem - 8683417 <br />
        Semester 1, 2014 - Assignment 1 <br />
        INB271 - Queensland University of Technology
    </div>
</div>

</div>

</body>
</html>
