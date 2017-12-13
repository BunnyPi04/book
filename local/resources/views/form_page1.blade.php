<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
* {
  	box-sizing: border-box;
}

body {
  	background-color: #f1f1f1;
}

#regForm {
    background-color: #ffffff;
 	margin: 100px auto;
  	font-family: Raleway;
  	padding: 40px;
  	width: 70%;
  	min-width: 300px;
}

h1 {
  	text-align: center;  
}

input {
  	padding: 10px;
  	width: 100%;
  	font-size: 17px;
  	font-family: Raleway;
  	border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  	background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
<body>

<div id="bubble">
    <div id="contain">
        <div id="q1" class="ques">
        <p>Chọn danh mục</p>
        <select id="q-1">
            <option value="Quần">Quần</option>
            <option value="Áo">Áo</option>
            <option value="Giày">Giày</option>
            <option value="Simple">Simple</option>
        </select>
        </div><!-- #q1 -->
        <div id="q2" class="ques">
        <p>Cỡ Quần</p>
        <select id="q-2">
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
        </select>
        </div><!-- #q2 -->
        <div id="q3" class="ques">
        <p>Cỡ Áo</p>
        <select id="q-3">
            <option value="XS">XS</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
        </select>
        </div><!-- #q3 -->
    </div>
    <div id="q4" class="ques">
        <p>Cỡ Giày</p>
        <select id="q-4">
            <option value="36">36</option>
            <option value="37">37</option>
            <option value="38">38</option>
            <option value="39">39</option>
            <option value="40">40</option>
            <option value="41">41</option>
            <option value="42">42</option>
        </select>
        </div><!-- #q3 -->
    </div>
</div><!-- #bubble -->
After selecting answer, it should fade into a new question/code.
<script>
$(document).ready(function(){
	$('#q1').show();

	$('#q-1').change(function(){
		$('.ques').fadeOut(800);
		
		var ans = $(this).val();
	//alert(ans);
		if (ans == 'Quần') {
			$('#q2').fadeIn(800);
			$('#q-2').change(function(){
				$('.ques').fadeOut(800);
				
				var ans = $(this).val();
			//alert(ans);
				if (ans == 'Quần') {
					$('#q2').fadeIn(800);
				} else if (ans == 'Áo') {
					$('#q3').fadeIn(800);
				} else if (ans == 'Giày') {
					$('#q4').fadeIn(800);
				}
			});
		} else if (ans == 'Áo') {
			$('#q3').fadeIn(800);
		} else if (ans == 'Giày') {
			$('#q4').fadeIn(800);
		}
	});
});
</script>

</body>
<style type="text/css">
	.ques{
		position:absolute;
		display:none;
	}
	#bubble {
	    width:220px;
	    height:150px;
	    background:url("http://i.imgur.com/MBRmEEf.png")no-repeat;
	    background-position:center;
	    background-size:200px;
	}
	#contain {
	    padding: 10px 0 0 30px;
	}
	select {
	    margin-left:10px;
	}
</style>
</html>