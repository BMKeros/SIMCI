@extends('layouts.plantilla_master')


@section('titulo')
	<title>SIMCI</title>
@stop

@section('contenido-body')
	<header><!--Barra de navegacion usuario-profesor-->
  		<div class="ui fixed menu">
    		<div class="ui container">
    			<a href="#" class="header item">
        			<img class="logo" src="/img/logo.png">
        			&nbsp;&nbsp;&nbsp;SIMCI
      			</a>
      			<div class="ui simple dropdown right item">
	        		{{ ucfirst(Auth::user()->usuario )}} <i class="dropdown icon"></i>
			        <div class="menu">
			        	<a class="item" href="#">Link Item</a>
			          	<a class="item" href="#">Link Item</a>
			          	<div class="divider"></div>
			          	<div class="header">Header Item</div>
			          	<div class="item">
			            	<i class="dropdown icon"></i>
			            	Sub Menu
			            	<div class="menu">
			              		<a class="item" href="#">Link Item</a>
			              		<a class="item" href="#">Link Item</a>
			            	</div>
			          	</div>
			          	<a class="item" href="#">Link Item</a>
			        </div>
		      	</div>
    		</div>
		</div>
	</header>
	
	<div class="ui grid" id="desplegable">
  		<!--Menu Desplegable de Usuario-Profesor-->
  		<div class="eight column row">
    		<div class="ui left vertical inverted labeled icon sidebar menu" id="usuario">
	    		<a class="item">
	      			<i class="home icon"></i>
	      			Home
	    		</a>
	    	
	    		<a class="item">
	      			<i class="block layout icon"></i>
	      			Topics
	    		</a>
	    	
	    		<a class="item">
	      			<i class="smile icon"></i>
	      			Friends
	    		</a>	
	    	
	    		<a class="item">
	      			<i class="calendar icon"></i>
	      			History
	    		</a>
	    	
	 	   		<a class="item">
	      			<i class="mail icon"></i>
	      			Messages
	    		</a>
	    	
	    		<a class="item">
	      			<i class="chat icon"></i>
	      			Discussions
	    		</a>
	    	
		    	<a class="item">
			      	<i class="trophy icon"></i>
			      	Achievements
		    	</a>
	    	
		    	<a class="item">
			      	<i class="shop icon"></i>
			      	Store
		    	</a>
	    	
		    	<a class="item">
			      	<i class="settings icon"></i>
			      	Settings
		    	</a>
    		</div>

    		<div class="ui animated fade big launch button" id="menu"  style="margin-top:100px;">
      			<div class="hidden content">
        			<div id="botton">Menu</div>
      			</div>
      			<div class="visible content">
        			<i class="sidebar icon"></i>
      			</div>
    		</div>
  		</div>
	</div>
@stop

@section('js')
	<script>
		$(document).ready(function(){
			$("#menu").click(function(){
		    	$('#usuario')
		    	.sidebar('setting', 'transition', 'overlay')
		    	.sidebar('toggle');
		  	});
		});
	</script>
@stop