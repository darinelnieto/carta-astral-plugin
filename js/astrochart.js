// ## Settings #############################

// ## SVG #####################

(function( astrology ) {

	var context;
	/**
	 * SVG tools.
	 * 
	 * @class
	 * @public
	 * @constructor
	 * @param {String} elementId - root DOM Element 
	 * @param {int} width
	 * @param {int} height 
	 */

	    astrology.SVG = function( elementId, width, height){		
		var svg = document.createElementNS( "http://www.w3.org/2000/svg", "svg");
		svg.setAttribute('style', "position: relative; overflow: hidden;");		
		svg.setAttribute('version', "1.1");						 				
		svg.setAttribute('width', width);
		svg.setAttribute('height', height);			
		svg.setAttributeNS("http://www.w3.org/2000/xmlns/", "xmlns:xlink", "http://www.w3.org/1999/xlink");				
		document.getElementById( elementId ).appendChild( svg );

		var wrapper = document.createElementNS(svg.namespaceURI, "g");
		wrapper.setAttribute('id', astrology.ID_CHART);
		svg.appendChild( wrapper );					
		this.DOMElement = svg;				
		this.root = wrapper;
		this.width = width;
		this.height = height;	
		context = this;
	};	

	/**
	 * Get a required symbol. 
	 * 
	 * @param {String} name
	 * @param {int} x
	 * @param {int} y
	 * 
	 * @return {SVG g}
	 */

	astrology.SVG.prototype.getSymbol = function( name, x, y){		

		switch(name) {
			case astrology.SYMBOL_SUN:		        
		        return sun( x, y);		        
		        break;
		    case astrology.SYMBOL_MOON:		        
		        return moon( x, y);		        
		        break;
		   case astrology.SYMBOL_MERCURY:		        
		        return mercury( x, y);		        
		        break;     
		   case astrology.SYMBOL_VENUS:		        
		        return venus( x, y);		        
		        break;	
		   case astrology.SYMBOL_MARS:		        
		        return mars( x, y);		        
	            break;
           case astrology.SYMBOL_JUPITER:		        
		        return jupiter( x, y);		        
		        break;
		   case astrology.SYMBOL_SATURN:		        
		        return saturn( x, y);		        
		        break; 
		   case astrology.SYMBOL_URANUS:		        
		        return uranus( x, y);		        
		        break;
		   case astrology.SYMBOL_NEPTUNE:		        
		        return neptune( x, y);		        
		        break;
		   case astrology.SYMBOL_PLUTO:		        
		        return pluto( x, y);		        
		        break;
		   case astrology.SYMBOL_CHIRON:		        
		        return chiron( x, y);		        
		        break;
		   case astrology.SYMBOL_LILITH:		        
		        return lilith( x, y);		        
		        break;
		   case astrology.SYMBOL_NNODE:		        
		        return nnode( x, y);		        
		        break;
		   case astrology.SYMBOL_SNODE:		        
		        return snode( x, y);		        
		        break;
		   case astrology.SYMBOL_PFORTUNAE:		        
		        return pfortunae( x, y);		        
		        break;
		   case astrology.SYMBOL_SICKNESS:		        
		        return sickness( x, y);		        
		        break;
		   case astrology.SYMBOL_ARIES:
				astrology.SIGNS_COLOR = astrology.COLOR_SIGNS[0];
		        return aries( x, y);
		        break;
		   case astrology.SYMBOL_TAURUS:
				astrology.SIGNS_COLOR = astrology.COLOR_SIGNS[1];
		        return taurus( x, y);		        
		        break;
		   case astrology.SYMBOL_GEMINI:		        
				astrology.SIGNS_COLOR = astrology.COLOR_SIGNS[2];
		        return gemini( x, y);		       
		        break;
		   case astrology.SYMBOL_CANCER:
				astrology.SIGNS_COLOR = astrology.COLOR_SIGNS[3];
		        return cancer( x, y);		        
		        break;
		   case astrology.SYMBOL_LEO:		        
				astrology.SIGNS_COLOR = astrology.COLOR_SIGNS[4];
		        return leo( x, y);		        
		        break;
		   case astrology.SYMBOL_VIRGO:
				astrology.SIGNS_COLOR = astrology.COLOR_SIGNS[5];
		        return virgo( x, y);		        
		        break;
		   case astrology.SYMBOL_LIBRA:		        
				astrology.SIGNS_COLOR = astrology.COLOR_SIGNS[6];
		        return libra( x, y);		        
		        break;
		   case astrology.SYMBOL_SCORPIO:		        
				astrology.SIGNS_COLOR = astrology.COLOR_SIGNS[7];
		        return scorpio( x, y);		        
		        break;
		   case astrology.SYMBOL_SAGITTARIUS:		        
				astrology.SIGNS_COLOR = astrology.COLOR_SIGNS[8];
		        return sagittarius( x, y);		        
		        break;
		   case astrology.SYMBOL_CAPRICORN:		        
				astrology.SIGNS_COLOR = astrology.COLOR_SIGNS[9];
		        return capricorn( x, y);		        
		        break;
		   case astrology.SYMBOL_AQUARIUS:		        
				astrology.SIGNS_COLOR = astrology.COLOR_SIGNS[10];
		        return aquarius( x, y);		        
		        break; 
		   case astrology.SYMBOL_PISCES:		        
				astrology.SIGNS_COLOR = astrology.COLOR_SIGNS[11];
		        return pisces( x, y);		        
		        break;		        
		   case astrology.SYMBOL_AS:
		        return ascendant( x, y );
		        break;		    
		   case astrology.SYMBOL_DS:		        
		        return descendant( x, y );		        
		        break;
		   case astrology.SYMBOL_MC:		        
		        return mediumCoeli( x, y );		        
		        break;
		   case astrology.SYMBOL_IC:		        
		        return immumCoeli( x, y );		        
		        break;	
		   case astrology.SYMBOL_IC:		        
		        return immumCoeli( x, y );		        
		        break;		    
		   case astrology.SYMBOL_CUSP_1:		        
		        return number1( x, y );		        
		        break;
	       case astrology.SYMBOL_CUSP_2:		        
		        return number2( x, y );		        
		        break;
	       case astrology.SYMBOL_CUSP_3:		        
		        return number3( x, y );		        
		        break;
	       case astrology.SYMBOL_CUSP_4:		        
		        return number4( x, y );		        
		        break;
	       case astrology.SYMBOL_CUSP_5:		        
		        return number5( x, y );		        
		        break;
	       case astrology.SYMBOL_CUSP_6:		        
		        return number6( x, y );		        
		        break;
	       case astrology.SYMBOL_CUSP_7:		        
		        return number7( x, y );		        
		        break;
	       case astrology.SYMBOL_CUSP_8:		        
		        return number8( x, y );		        
		        break;
	      case astrology.SYMBOL_CUSP_9:		        
		        return number9( x, y );		        
		        break;
	      case astrology.SYMBOL_CUSP_10:		        
		        return number10( x, y );		        
		        break;
	      case astrology.SYMBOL_CUSP_11:		        
		        return number11( x, y );		        
		        break;
	      case astrology.SYMBOL_CUSP_12:		        
		        return number12( x, y );		        
		        break; 		                                                                                              	
		  default:
		    	var unknownPoint = this.circle(x, y, 8);
		    	unknownPoint.setAttribute("stroke", "#ffff00");		 
				unknownPoint.setAttribute("stroke-width", 1);
		    	unknownPoint.setAttribute("fill", "#ff0000");		    							    			    			    			    		
	    	    return unknownPoint;	 
		}			
	};


	/*
	 * Sun path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVG g}
	 */

	function sun( x, y ){
		// center symbol
		var xShift = -1; //px						
		var yShift = -8; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));
		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " -2.18182,0.727268 -2.181819,1.454543 -1.454552,2.18182 -0.727268,2.181819 0,2.181819 0.727268,2.181819 1.454552,2.18182 2.181819,1.454544 2.18182,0.727276 2.18181,0 2.18182,-0.727276 2.181819,-1.454544 1.454552,-2.18182 0.727268,-2.181819 0,-2.181819 -0.727268,-2.181819 -1.454552,-2.18182 -2.181819,-1.454543 -2.18182,-0.727268 -2.18181,0 m 0.727267,6.54545 -0.727267,0.727276 0,0.727275 0.727267,0.727268 0.727276,0 0.727267,-0.727268 0,-0.727275 -0.727267,-0.727276 -0.727276,0 m 0,0.727276 0,0.727275 0.727276,0 0,-0.727275 -0.727276,0");				

		node.setAttribute("stroke", astrology.COLOR_SUN);// astrology.POINTS_COLOR);		 
		node.setAttribute("stroke-width", astrology.POINTS_STROKE);					
		node.setAttribute("fill", "none");
		wrapper.appendChild(node);
		return wrapper;
	};

	/*
	 * Moon path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function moon( x, y ){
		// center symbol
		var xShift = -2; //px						
		var yShift = -7; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		
		node.setAttribute("d", "m" + x + ", " + y + " a 7.4969283,7.4969283 0 0 1 0,14.327462 7.4969283,7.4969283 0 1 0 0,-14.327462 z");				
		node.setAttribute("stroke", astrology.COLOR_MOON);//astrology.POINTS_COLOR);		 
		node.setAttribute("stroke-width", astrology.POINTS_STROKE);
		node.setAttribute("fill","none");			
		wrapper.appendChild(node);
		return wrapper;


	};

	/*
	 * Mercury path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function mercury( x, y ){
		// center symbol
		var xShift = -2; //px						
		var yShift = 7; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var body = document.createElementNS( context.root.namespaceURI, "path");
		body.setAttribute("d", "m" + x + ", " + y + " 4.26011,0 m -2.13005,-2.98207 0,5.11213 m 4.70312,-9.7983 a 4.70315,4.70315 0 0 1 -4.70315,4.70314 4.70315,4.70315 0 0 1 -4.70314,-4.70314 4.70315,4.70315 0 0 1 4.70314,-4.70315 4.70315,4.70315 0 0 1 4.70315,4.70315 z");				
		body.setAttribute("stroke", astrology.COLOR_MERCURY);//astrology.POINTS_COLOR);		 
		body.setAttribute("stroke-width", astrology.POINTS_STROKE);
		body.setAttribute("fill","none");			
		wrapper.appendChild( body );
		var crownXShift = 6; //px						
		var crownYShift = -16; //px
		var crown = document.createElementNS( context.root.namespaceURI, "path");
		crown.setAttribute("d", "m" + (x + crownXShift) + ", " + (y + crownYShift) + " a 3.9717855,3.9717855 0 0 1 -3.95541,3.59054 3.9717855,3.9717855 0 0 1 -3.95185,-3.59445");				
		crown.setAttribute("stroke", astrology.COLOR_MERCURY);//astrology.POINTS_COLOR);		 
		crown.setAttribute("stroke-width", astrology.POINTS_STROKE);
		crown.setAttribute("fill", "none");			
		wrapper.appendChild( crown );
		return wrapper;
	};

	/*
	 * Venus path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function venus( x, y ){
		// center symbol

		var xShift = 2; //px						
		var yShift = 7; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");

		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " -4.937669,0.03973 m 2.448972,2.364607 0,-5.79014 c -3.109546,-0.0085 -5.624617,-2.534212 -5.620187,-5.64208 0.0044,-3.107706 2.526514,-5.621689 5.635582,-5.621689 3.109068,0 5.631152,2.513983 5.635582,5.621689 0.0044,3.107868 -2.510641,5.633586 -5.620187,5.64208");				
		node.setAttribute("stroke", astrology.COLOR_VENUS);//astrology.POINTS_COLOR);		 
		node.setAttribute("stroke-width", astrology.POINTS_STROKE);
		node.setAttribute("fill","none");												
		wrapper.appendChild(node);
		return wrapper;
	};

	/*
	 * Mars path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
     * @return {SVGPathElement} path
	 */

	function mars( x, y ){
		// center symbol
		var xShift = 2; //px						
		var yShift = -2; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");								
		node.setAttribute("d", "m" + x + ", " + y + " c -5.247438,-4.150623 -11.6993,3.205518 -7.018807,7.886007 4.680494,4.680488 12.036628,-1.771382 7.885999,-7.018816 z m 0,0 0.433597,0.433595 3.996566,-4.217419 m -3.239802,-0.05521 3.295015,0 0.110427,3.681507");			
    	node.setAttribute("stroke", astrology.COLOR_MARS);//astrology.POINTS_COLOR);		 
		node.setAttribute("stroke-width", astrology.POINTS_STROKE);
		node.setAttribute("fill", "none");			
		wrapper.appendChild(node);
		return wrapper;

	};

	/*
	 * Jupiter path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function jupiter( x, y ){
    	// center symbol
		var xShift = -5; //px						
		var yShift = -2; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " c -0.43473,0 -1.30422,-0.40572 -1.30422,-2.02857 0,-1.62285 1.73897,-3.2457 3.47792,-3.2457 1.73897,0 3.47792,1.21715 3.47792,4.05713 0,2.83999 -2.1737,7.30283 -6.52108,7.30283 m 12.17269,0 -12.60745,0 m 9.99902,-11.76567 0,15.82279");				
		node.setAttribute("stroke", astrology.COLOR_JUPITER);//astrology.POINTS_COLOR);		 
		node.setAttribute("stroke-width", astrology.POINTS_STROKE);
		node.setAttribute("fill", "none");													
		wrapper.appendChild(node);

		return wrapper;
	};

	/*
	 * Saturn path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function saturn( x, y ){
		// center symbol
		var xShift = 5; //px						
		var yShift = 10; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " c -0.52222,0.52221 -1.04445,1.04444 -1.56666,1.04444 -0.52222,0 -1.56667,-0.52223 -1.56667,-1.56667 0,-1.04443 0.52223,-2.08887 1.56667,-3.13332 1.04444,-1.04443 2.08888,-3.13331 2.08888,-5.22219 0,-2.08888 -1.04444,-4.17776 -3.13332,-4.17776 -1.97566,0 -3.65555,1.04444 -4.69998,3.13333 m -2.55515,-5.87499 6.26664,0 m -3.71149,-2.48054 0,15.14438");				
		node.setAttribute("stroke", astrology.COLOR_SATURN);//astrology.POINTS_COLOR);		 
		node.setAttribute("stroke-width", astrology.POINTS_STROKE);
		node.setAttribute("fill", "none");												
		wrapper.appendChild(node);
		return wrapper;

	};

	/*
	 * Uranus path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function uranus( x, y ){

    	// center symbol
		var xShift = -5; //px						
		var yShift = -7; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var horns = document.createElementNS( context.root.namespaceURI, "path");
		horns.setAttribute("d", "m" + x + ", " + y + "  0,10.23824 m 10.23633,-10.32764 0,10.23824 m -10.26606,-4.6394 10.23085,0 m -5.06415,-5.51532 0,11.94985");				
		horns.setAttribute("stroke", astrology.COLOR_URANUS);//astrology.POINTS_COLOR);		 
		horns.setAttribute("stroke-width", astrology.POINTS_STROKE);
		horns.setAttribute("fill", "none");												
		wrapper.appendChild(horns);

		var bodyXShift = 7; //px						
		var bodyYShift = 14.5; //px
		var body = document.createElementNS( context.root.namespaceURI, "path");
		body.setAttribute("d", "m" + (x + bodyXShift) + ", " + (y + bodyYShift) + " a 1.8384377,1.8384377 0 0 1 -1.83844,1.83843 1.8384377,1.8384377 0 0 1 -1.83842,-1.83843 1.8384377,1.8384377 0 0 1 1.83842,-1.83844 1.8384377,1.8384377 0 0 1 1.83844,1.83844 z");				
		body.setAttribute("stroke", astrology.COLOR_URANUS);//astrology.POINTS_COLOR);
		body.setAttribute("stroke-width", astrology.POINTS_STROKE); 			
		body.setAttribute("fill", "none");	 									
		wrapper.appendChild( body );

		return wrapper;

	};

	/*
	 * Neptune path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function neptune( x, y ){

		// center symbol
		var xShift = 3; //px						
		var yShift = -5; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " 1.77059,-2.36312 2.31872,1.8045 m -14.44264,-0.20006 2.34113,-1.77418 1.74085,2.38595 m -1.80013,-1.77265 c -1.23776,8.40975 0.82518,9.67121 4.95106,9.67121 4.12589,0 6.18883,-1.26146 4.95107,-9.67121 m -7.05334,3.17005 2.03997,-2.12559 2.08565,2.07903 m -5.32406,9.91162 6.60142,0 m -3.30071,-12.19414 0,15.55803");				
		node.setAttribute("stroke", astrology.COLOR_NEPTUNE);//astrology.POINTS_COLOR);		 
		node.setAttribute("stroke-width", astrology.POINTS_STROKE);
		node.setAttribute("fill", "none");														
    	wrapper.appendChild(node);

		return wrapper;

	};

	/*
	 * Pluto path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function pluto( x, y ){

		// center symbol
		var xShift = 5; //px						
		var yShift = -5; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var body = document.createElementNS( context.root.namespaceURI, "path");
		body.setAttribute("d", "m" + x + ", " + y + " a 5.7676856,5.7676856 0 0 1 -2.88385,4.99496 5.7676856,5.7676856 0 0 1 -5.76768,0 5.7676856,5.7676856 0 0 1 -2.88385,-4.99496 m 5.76771,13.93858 0,-8.17088 m -3.84512,4.32576 7.69024,0");				
		body.setAttribute("stroke", astrology.COLOR_PLUTO);//astrology.POINTS_COLOR);		 
		body.setAttribute("stroke-width", astrology.POINTS_STROKE);
		body.setAttribute("fill", "none");														
		wrapper.appendChild(body);

    	var headXShift = -2.3; //px						
		var headYShift = 0; //px
		var head = document.createElementNS( context.root.namespaceURI, "path");
		head.setAttribute("d", "m" + (x + headXShift) + ", " + (y + headYShift) + " a 3.3644834,3.3644834 0 0 1 -3.36448,3.36449 3.3644834,3.3644834 0 0 1 -3.36448,-3.36449 3.3644834,3.3644834 0 0 1 3.36448,-3.36448 3.3644834,3.3644834 0 0 1 3.36448,3.36448 z");				
		head.setAttribute("stroke", astrology.COLOR_PLUTO);//astrology.POINTS_COLOR);		 
		head.setAttribute("stroke-width", astrology.POINTS_STROKE);
		head.setAttribute("fill", "none");														
		wrapper.appendChild(head);

		return wrapper;

	};

	/*
	 * Chiron path
	 * @private
	 * 
	 * @param {int} x
     * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function chiron( x, y ){

		// center symbol
		var xShift = 3; //px
		var yShift = 5; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var body = document.createElementNS( context.root.namespaceURI, "path");  
		body.setAttribute("d", "m" + x + ", " + y + " a 3.8764725,3.0675249 0 0 1 -3.876473,3.067525 3.8764725,3.0675249 0 0 1 -3.876472,-3.067525 3.8764725,3.0675249 0 0 1 3.876472,-3.067525 3.8764725,3.0675249 0 0 1 3.876473,3.067525 z");
	    body.setAttribute("stroke", astrology.POINTS_COLOR);		 
		body.setAttribute("stroke-width", astrology.POINTS_STROKE);
		body.setAttribute("fill", "none");												
		wrapper.appendChild( body );

		var headXShift = 0; //px						
		var headYShift = -13; //px
		var head = document.createElementNS( context.root.namespaceURI, "path");
		head.setAttribute("d", "m" + (x + headXShift) + ", " + (y + headYShift) + "   -3.942997,4.243844 4.110849,3.656151 m -4.867569,-9.009468 0,11.727251");
		head.setAttribute("stroke", astrology.POINTS_COLOR);		 
		head.setAttribute("stroke-width", astrology.POINTS_STROKE);
		head.setAttribute("fill", "none");												
		wrapper.appendChild( head );

		return wrapper;

	};

	/*
	 * Sickness path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function sickness( x, y ){

		// center symbol
		var xShift = 3 - 10; //px
		var yShift = 5 - 15; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));
		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
    	wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");  
		
        node.setAttribute("d","m 172,581 h 1 z m 236,-7 h -1 z m 0,5 c 4.08961,-18.65022 2.35503,-39.79249 -4,-58.28125 -1.86435,-5.70408 -5.368,-13.89519 -9.45367,-20.847 C 379.61783,474.46888 356.63784,454.6271 328,446 c -6.05801,-24.87873 -0.68048,-59.56553 -2.48474,-88.25177 -1.12657,-18.44739 -3.85319,-39.54156 20.20453,-32.74823 33.09341,0 66.18681,0 99.28021,0 3.03428,8.91673 6.7681,20.09034 12,26 8.31005,15.2895 22.70705,29.57201 36.162,39.162 17.08779,10.19939 38.23871,19.68895 59.838,18.838 8.49098,2.50088 38.51187,-1.10942 14.43149,-3.49016 -17.9472,-4.83756 -34.06316,-12.17914 -47.51158,-24.57213 -17.42522,-12.82211 -29.3606,-32.0105 -36.71704,-52.12621 -6.32663,-16.65725 -6.85113,-34.53175 -5.80431,-52.40575 C 480.85929,257.56487 485.89876,238.42341 498,223 c 2.59239,-4.61276 9.6814,-13.4005 13,-16 10.72653,-12.16334 26.18603,-21.66555 42,-28 5.24705,-2.65869 30.22014,-6.49016 23.36937,-7.20383 C 559.86267,168.99456 545.40169,170.78751 530,174 c -22.26227,6.68388 -43.81641,17.94146 -59,36 -14.01869,14.00096 -22.46868,31.74595 -27,51 -0.0312,8.32973 -13.9729,3.95803 -21.71979,5 -32.09341,0 -64.18681,0 -96.28021,0 -1.07356,-43.27908 -0.003,-86.87808 0,-130 21.29697,-7.99751 41.83716,-19.28803 56,-38 5.73354,-7.015559 13.16503,-16.572049 16.5,-25.125 4.57107,-8.932107 7.9306,-19.404043 9.79756,-30.148135 C 409.68833,29.034862 411.90542,14.432409 408,1 c -0.45474,10.559179 -5.03799,19.783861 -7,29 -4.02407,6.598971 -7.08058,14.892914 -11.46983,20.939653 C 381.02985,63.385805 369.16786,74.810631 357.625,83.375 348.05039,90.387859 333.11747,97.008346 320,100 290.9386,108.14791 257.26429,103.73116 232,88.625 221.40341,83.346533 212.21903,74.861735 203,66 197.24582,55.902161 188.20863,48.917957 183.7726,37.95434 177.24189,26.09561 175.10693,11.642224 172,0 c -0.99704,18.244611 -1.91221,36.405459 4,54 2.73956,12.500177 11.83307,24.650149 17,37 16.39586,20.64352 37.64662,37.88618 62.52767,43.98608 13.23863,-0.14314 12.28513,10.26046 11.47233,20.44708 0,36.85561 0,73.71123 0,110.56684 -42.78235,-0.0451 -85.64022,1.23004 -128.375,-0.125 C 136.6296,254.51572 132.97054,246.69154 129,236 122.68771,228.14359 117.70598,216.89511 109.63296,209.08708 88.494042,187.54998 60.24647,172.3613 30,171 c -7.113156,-0.78069 -41.042821,-0.3572 -19.408231,3.28375 13.750576,1.82754 22.846796,7.33126 35.445987,14.05588 10.970529,4.28768 18.104516,14.22264 26.286244,19.98437 13.458202,14.99086 24.01891,33.38578 28.44186,53.66506 C 106.78121,286.0549 104.59442,311.97309 96,335 91.296122,345.32071 83.82405,358.46972 75.5,368.1875 61.154878,384.32344 41.793117,394.24092 21.900348,401.8561 15.70119,406.26373 -7.6948542,408.8231 11,409 c 14.369555,2.60472 28.650994,-2.11078 43,-3 14.562155,-5.92746 32.407016,-13.21282 44.81557,-25.12183 C 117.4217,366.283 129.05081,346.97591 136.375,325.375 179.87825,324.50521 223.46458,325.24602 267,325 c 0,39 0,78 0,117 -17.39011,3.56529 -33.60956,13.37263 -49.28321,22.02657 -8.50064,6.11615 -13.90119,13.32246 -19.70278,19.28808 -20.80883,25.12182 -29.7088,58.42832 -26.01401,90.97198 -0.0613,12.53862 3.62328,-11.04246 5.55899,-15.96359 C 184.30328,536.46561 198.20023,519.0366 215,503 c 10.60597,-6.77526 22.86929,-16.27226 37,-20 8.84286,-2.65529 19.7169,-4.11146 27.9097,-6.44634 17.76835,-1.66761 33.82025,1.54284 51.0903,6.44634 5.7013,2.31631 15.45638,6.88568 22.55899,11.51966 23.59897,15.19053 42.03878,38.21623 50.17592,64.95017 C 406.62665,565.51843 407.072,572.637 408,579 Z M 294,476 v 1 z m -1,0 v 1 z m -3,0 v 1 z m -45,10 h 1 z m -14,6 h 1 z m -14,10 h 1 z m -11,9 v 0.375 z m -9,12 v -1 z m -16,28 v -1 z m 1,-44 v 1 z m 48,-51 h -1 z M 91,387 h 1 z m -8,7 v -1 z m -33,12 v 1 z m -1,0 v 1 z m -36,3 v 1 z M 1,408 h 1 z m 2,0 -1,-1 z m 31,-9 h -1 z m 2,-2 h 0.375 z m 3,-2 v 1 z M 83,221 H 82 Z M 15,175 h 1 z M 4,173 h 1 z m 72,11 v -1 z m 22,14 v -1 z m 164,-61 v 1 z m 0,0 v 1 z m -48,-23 h 1 z M 184,76 h -0.375 z m 35,4 c -1.44782,-2.969688 -1.21384,0.425277 0,0 z m 44,21 h 0.375 z m 23,3 h -1 z m 3,0 h -1 z m 42,-7 h -1 z m 56,-44 v 1 z M 409,1 v 0.375 z m 1,21 v 0.375 z m -7,41 v -0.375 z m -9,20 v -1 z m -10,14 v -1 z m -55,38 h 1 z m 128,94 h -1 z m 61,-52 h 0.375 z m 1,1 v -0.375 z m 32,3 v -1 z m -23,11 h 1 z m -29,166 h -1 z m 22,25 v -1 z m 37,19 h -1 z m 8,3 v -0.375 z m 13,3 v -1 z m -11,1 v 1 z m -16,0 v 1 z m -1,0 v 1 z m -20,-3 c 2.80465,1.59218 -0.24752,1.05836 0,0 z m 0,0 v 1 z m -20,-6 h 1 z m -177,47 h -1 z m 33,20 v -1 z m 17,16 v 0.375 z m 20,35 h -1 z m 5,28 h 1 z");		

//node.setAttribute("d", "m" + x + ", " + y + " -2.525435,-1.12853 -1.464752,-1.79539 -0.808138,-2.20576 0.151526,-2.05188 0.909156,-1.5389 1.010173,-1.02593 0.909157,-0.56427 1.363735,-0.61556 m 2.315327,-0.39055 -1.716301,0.54716 -1.7163,1.09431 -1.1442,1.64146 -0.572102,1.64146 0,1.64146 0.572102,1.64147 1.1442,1.64145 1.7163,1.09432 1.716301,0.54715 m 0,-11.49024 -2.2884,0 -2.288401,0.54716 -1.716302,1.09431 -1.144201,1.64146 -0.5721,1.64146 0,1.64146 0.5721,1.64147 1.144201,1.64145 1.716302,1.09432 2.288401,0.54715 2.2884,0 m -4.36712,-0.4752 0,6.44307 m -2.709107,-3.41101 5.616025,0");            
		    //node.setAttribute("transform", "scale(0.045)");
		    node.setAttribute("transform", "translate(" + x + " " + y + ") scale(0.03)");
		    node.setAttribute("stroke", astrology.POINTS_COLOR);
			node.setAttribute("stroke-width", astrology.POINTS_STROKE);
			//node.setAttribute("fill", "none");												
			node.setAttribute("fill", "#000000");												
			wrapper.appendChild( node );
    		return wrapper;

	};
	
	/*
	 * Lilith path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function lilith( x, y ){

		// center symbol
		var xShift = 2; //px						
		var yShift = 4; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " -2.525435,-1.12853 -1.464752,-1.79539 -0.808138,-2.20576 0.151526,-2.05188 0.909156,-1.5389 1.010173,-1.02593 0.909157,-0.56427 1.363735,-0.61556 m 2.315327,-0.39055 -1.716301,0.54716 -1.7163,1.09431 -1.1442,1.64146 -0.572102,1.64146 0,1.64146 0.572102,1.64147 1.1442,1.64145 1.7163,1.09432 1.716301,0.54715 m 0,-11.49024 -2.2884,0 -2.288401,0.54716 -1.716302,1.09431 -1.144201,1.64146 -0.5721,1.64146 0,1.64146 0.5721,1.64147 1.144201,1.64145 1.716302,1.09432 2.288401,0.54715 2.2884,0 m -4.36712,-0.4752 0,6.44307 m -2.709107,-3.41101 5.616025,0");			
		node.setAttribute("stroke", astrology.POINTS_COLOR);		 
		node.setAttribute("stroke-width", astrology.POINTS_STROKE);
		node.setAttribute("fill", "none");															
		wrapper.appendChild(node);
		return wrapper;

	};

	/*
	 * NNode path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function nnode( x, y ){

		// center symbol
		var xShift = -2; //px						
		var yShift = 3; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " -1.3333334,-0.6666667 -0.6666666,0 -1.3333334,0.6666667 -0.6666667,1.3333333 0,0.6666667 0.6666667,1.3333333 1.3333334,0.6666667 0.6666666,0 1.3333334,-0.6666667 0.6666666,-1.3333333 0,-0.6666667 -0.6666666,-1.3333333 -2,-2.66666665 -0.6666667,-1.99999995 0,-1.3333334 0.6666667,-2 1.3333333,-1.3333333 2,-0.6666667 2.6666666,0 2,0.6666667 1.3333333,1.3333333 0.6666667,2 0,1.3333334 -0.6666667,1.99999995 -2,2.66666665 -0.6666666,1.3333333 0,0.6666667 0.6666666,1.3333333 1.3333334,0.6666667 0.6666666,0 1.3333334,-0.6666667 0.6666667,-1.3333333 0,-0.6666667 -0.6666667,-1.3333333 -1.3333334,-0.6666667 -0.6666666,0 -1.3333334,0.6666667 m -7.9999999,-6 0.6666667,-1.3333333 1.3333333,-1.3333333 2,-0.6666667 2.6666666,0 2,0.6666667 1.3333333,1.3333333 0.6666667,1.3333333");				
		node.setAttribute("stroke", astrology.POINTS_COLOR);		 
		node.setAttribute("stroke-width", astrology.POINTS_STROKE);
		node.setAttribute("fill", "none");	
		wrapper.appendChild(node);

		return wrapper;

	};

	/*
	 * SNode path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function snode( x, y ){

		// center symbol
		var xShift = -2; //px						
		var yShift = 3; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " -1.3333334,-0.6666667 -0.6666666,0 -1.3333334,0.6666667 -0.6666667,1.3333333 0,0.6666667 0.6666667,1.3333333 1.3333334,0.6666667 0.6666666,0 1.3333334,-0.6666667 0.6666666,-1.3333333 0,-0.6666667 -0.6666666,-1.3333333 -2,-2.66666665 -0.6666667,-1.99999995 0,-1.3333334 0.6666667,-2 1.3333333,-1.3333333 2,-0.6666667 2.6666666,0 2,0.6666667 1.3333333,1.3333333 0.6666667,2 0,1.3333334 -0.6666667,1.99999995 -2,2.66666665 -0.6666666,1.3333333 0,0.6666667 0.6666666,1.3333333 1.3333334,0.6666667 0.6666666,0 1.3333334,-0.6666667 0.6666667,-1.3333333 0,-0.6666667 -0.6666667,-1.3333333 -1.3333334,-0.6666667 -0.6666666,0 -1.3333334,0.6666667 m -7.9999999,-6 0.6666667,-1.3333333 1.3333333,-1.3333333 2,-0.6666667 2.6666666,0 2,0.6666667 1.3333333,1.3333333 0.6666667,1.3333333");				
		node.setAttribute("stroke", astrology.POINTS_COLOR);		 
		node.setAttribute("stroke-width", astrology.POINTS_STROKE);
		node.setAttribute("fill", "none");	
		node.setAttribute("transform", "rotate(180 " + x + " " + y +  ")");
		wrapper.appendChild(node);
		return wrapper;

	};

	/*
	 * PFortunae path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function pfortunae( x, y ){

		// center symbol
		var xShift = -2; //px						
		var yShift = 3; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		//node.setAttribute("d", "m" + x + ", " + y + "-2.18182,0.727268 -2.181819,1.454543 -1.454552,2.18182 -0.727268,2.181819 0,2.181819 0.727268,2.181819 1.454552,2.18182 2.181819,1.454544 2.18182,0.727276 2.18181,0 2.18182,-0.727276 2.181819,-1.454544 1.454552,-2.18182 0.727268,-2.181819 0,-2.181819 -0.727268,-2.181819 -1.454552,-2.18182 -2.181819,-1.454543 -2.18182,-0.727268 -2.18181,0");				
		//node.setAttribute("d", "m" + x + ", " + y + "a7 7 0 1 0 2 0z, m1 0, v14, m-7 -7 h14");				
		//x += 3.5;
		//node.setAttribute("d", "m" + x + ", " + y + "a7 7 0 1 0 2 0z, m1 0, v14, m-7 -7 h14");
		//Sun node.setAttribute("d", "m" + x + ", " + y + " -2.18182,0.727268 -2.181819,1.454543 -1.454552,2.18182 -0.727268,2.181819 0,2.181819 0.727268,2.181819 1.454552,2.18182 2.181819,1.454544 2.18182,0.727276 2.18181,0 2.18182,-0.727276 2.181819,-1.454544 1.454552,-2.18182 0.727268,-2.181819 0,-2.181819 -0.727268,-2.181819 -1.454552,-2.18182 -2.181819,-1.454543 -2.18182,-0.727268 -2.18181,0 m 0.727267,6.54545 -0.727267,0.727276 0,0.727275 0.727267,0.727268 0.727276,0 0.727267,-0.727268 0,-0.727275 -0.727267,-0.727276 -0.727276,0 m 0,0.727276 0,0.727275 0.727276,0 0,-0.727275 -0.727276,0");				
		y -= 6;
        x += 2;
		//node.setAttribute("d", "m" + x + ", " + y + " a 6 6 0 1 0 2 0z, m1 0, v12, m-6 -6 h12");

		node.setAttribute("d", "m" + x + ", " + y + " a 6 6 0 1 0 2 0z m1 0 v12 m-6 -6 h12");			
		node.setAttribute("stroke", astrology.POINTS_COLOR);		 
		node.setAttribute("stroke-width", astrology.POINTS_STROKE);
		node.setAttribute("fill", "none");	
		//node.setAttribute("transform", "rotate(180 " + x + " " + y +  ")");
		wrapper.appendChild(node);

		return wrapper;

	};

	/*
	 * Aries symbol path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function aries( x, y ){

		// center symbol
		var xShift = -9; //px						
		var yShift = -2; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));
		//x =  Math.round(x + (xShift * astrology.SIGN_SCALE));
		//y =  Math.round(y + (yShift * astrology.SIGN_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m " + x + ", " + y + " -0.9,-0.9 0,-1.8 0.9,-1.8 1.8,-0.8999998 1.8,0 1.8,0.8999998 0.9,0.9 0.9,1.8 0.9,4.5 m -9,-5.4 1.8,-1.8 1.8,0 1.8,0.9 0.9,0.9 0.9,1.8 0.9,3.6 0,9.9 m 8.1,-12.6 0.9,-0.9 0,-1.8 -0.9,-1.8 -1.8,-0.8999998 -1.8,0 -1.8,0.8999998 -0.9,0.9 -0.9,1.8 -0.9,4.5 m 9,-5.4 -1.8,-1.8 -1.8,0 -1.8,0.9 -0.9,0.9 -0.9,1.8 -0.9,3.6 0,9.9");
		node.setAttribute("stroke", astrology.SIGNS_COLOR);		 
		node.setAttribute("stroke-width", astrology.SIGNS_STROKE);			
		node.setAttribute("fill", "none");	
		wrapper.appendChild(node);
		return wrapper;

	};

	/*
	 * Taurus symbol path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function taurus( x, y ){

		// center symbol
		var xShift = -9; //px						
		var yShift = -11; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));
		//x =  Math.round(x + (xShift * astrology.SIGN_SCALE));
		//y =  Math.round(y + (yShift * astrology.SIGN_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m " + x + ", " + y + " 1,4 1,2 2,2 3,1 4,0 3,-1 2,-2 1,-2 1,-4 m -18,0 1,3 1,2 2,2 3,1 4,0 3,-1 2,-2 1,-2 1,-3 m -11,8 -2,1 -1,1 -1,2 0,3 1,2 2,2 2,1 2,0 2,-1 2,-2 1,-2 0,-3 -1,-2 -1,-1 -2,-1 m -4,1 -2,1 -1,2 0,3 1,3 m 8,0 1,-3 0,-3 -1,-2 -2,-1");				
		node.setAttribute("stroke", astrology.SIGNS_COLOR);		 
		node.setAttribute("stroke-width", astrology.SIGNS_STROKE);			
		node.setAttribute("fill", "none");												
		wrapper.appendChild(node);
    	return wrapper;

	};

	/*
	 * Gemini symbol path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function gemini( x, y ){

    	// center symbol
		var xShift = -6; //px						
		var yShift = -6; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));
		//x =  Math.round(x + (xShift * astrology.SIGN_SCALE));
		//y =  Math.round(y + (yShift * astrology.SIGN_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m " + x + ", " + y + " 0,11.546414 m 0.9622011,-10.5842129 0,9.6220117 m 7.6976097,-9.6220117 0,9.6220117 m 0.962201,-10.5842128 0,11.546414 m -13.4708165,-14.4330172 1.9244023,1.924402 1.9244024,0.9622012 2.8866038,0.9622011 3.848804,0 2.886604,-0.9622011 1.924402,-0.9622012 1.924403,-1.924402 m -17.3196215,17.3196207 1.9244023,-1.9244024 1.9244024,-0.9622011 2.8866038,-0.9622012 3.848804,0 2.886604,0.9622012 1.924402,0.9622011 1.924403,1.9244024");				
		node.setAttribute("stroke", astrology.SIGNS_COLOR);		 
		node.setAttribute("stroke-width", astrology.SIGNS_STROKE);			
		node.setAttribute("fill", "none");												
		wrapper.appendChild(node);
		return wrapper;

	};

	/*
	 * Cancer symbol path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function cancer( x, y ){

		// center symbol
		var xShift = 9; //px						
		var yShift = -9; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));
		//x =  Math.round(x + (xShift * astrology.SIGN_SCALE));
		//y =  Math.round(y + (yShift * astrology.SIGN_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m " + x + ", " + y + " -15,0 -2,1 -1,2 0,2 1,2 2,1 2,0 2,-1 1,-2 0,-2 -1,-2 11,0 m -18,3 1,2 1,1 2,1 m 4,-4 -1,-2 -1,-1 -2,-1 m -4,15 15,0 2,-1 1,-2 0,-2 -1,-2 -2,-1 -2,0 -2,1 -1,2 0,2 1,2 -11,0 m 18,-3 -1,-2 -1,-1 -2,-1 m -4,4 1,2 1,1 2,1");				
		node.setAttribute("stroke", astrology.SIGNS_COLOR);		 
		node.setAttribute("stroke-width", astrology.SIGNS_STROKE);			
		node.setAttribute("fill", "none");												
		wrapper.appendChild(node);
		return wrapper;

	};

	/*
	 * Leo symbol path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function leo( x, y ){

		// center symbol
		var xShift = -3; //px						
		var yShift = 4; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));
		//x =  Math.round(x + (xShift * astrology.SIGN_SCALE));
		//y =  Math.round(y + (yShift * astrology.SIGN_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m " + x + ", " + y + " -2,-1 -1,0 -2,1 -1,2 0,1 1,2 2,1 1,0 2,-1 1,-2 0,-1 -1,-2 -5,-5 -1,-2 0,-3 1,-2 2,-1 3,-1 4,0 4,1 2,2 1,2 0,3 -1,3 -3,3 -1,2 0,2 1,2 2,0 1,-1 1,-2 m -13,-5 -2,-3 -1,-2 0,-3 1,-2 1,-1 m 7,-1 3,1 2,2 1,2 0,3 -1,3 -2,3");				
		node.setAttribute("stroke", astrology.SIGNS_COLOR);		 
		node.setAttribute("stroke-width", astrology.SIGNS_STROKE);			
		node.setAttribute("fill", "none");												
		wrapper.appendChild(node);
		return wrapper;

	};

	/*
	 * Virgo symbol path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function virgo( x, y ){

		// center symbol
		var xShift = -9; //px						
		var yShift = -5; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));
		//x =  Math.round(x + (xShift * astrology.SIGN_SCALE));
		//y =  Math.round(y + (yShift * astrology.SIGN_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m " + x + ", " + y + " 2.5894868,-2.5894868 1.7263245,2.5894868 0,9.4947847 m -2.5894868,-11.2211092 1.7263245,2.5894867 0,8.6316225 m 0.8631623,-9.4947847 2.5894867,-2.5894868 1.72632451,2.5894868 0,8.6316224 m -2.58948671,-10.3579469 1.72632447,2.5894867 0,7.7684602 m 0.86316224,-8.6316224 2.58948679,-2.5894868 1.7263244,2.5894868 0,13.8105959 m -2.5894867,-15.5369204 1.7263245,2.5894867 0,12.9474337 m 0.8631622,-13.8105959 2.5894868,-2.5894868 0.8631622,1.7263245 0.8631623,2.5894868 0,2.5894867 -0.8631623,2.58948673 -0.8631622,1.72632447 -1.7263245,1.7263245 -2.5894867,1.7263245 -4.3158113,1.7263245 m 7.7684602,-15.5369204 0.8631623,0.8631622 0.8631622,2.5894868 0,2.5894867 -0.8631622,2.58948673 -0.8631623,1.72632447 -1.7263245,1.7263245 -2.5894867,1.7263245 -3.452649,1.7263245");				
		node.setAttribute("stroke", astrology.SIGNS_COLOR);		 
		node.setAttribute("stroke-width", astrology.SIGNS_STROKE);			
		node.setAttribute("fill", "none");												
		wrapper.appendChild(node);
		return wrapper;

	};

	/*
	 * Libra symbol path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function libra_old( x, y ){

		// center symbol
		var xShift = -4; //px						
		var yShift = 3; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));
		//x =  Math.round(x + (xShift * astrology.SIGN_SCALE));
		//y =  Math.round(y + (yShift * astrology.SIGN_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		//node.setAttribute("d", "m " + x + ", " + y + " -1.7142857,-0.8571429 -0.8571429,0 -1.7142857,0.8571429 -0.8571429,1.7142857 0,0.8571429 0.8571429,1.7142857 1.7142857,0.8571428 0.8571429,0 1.7142857,-0.8571428 0.8571428,-1.7142857 0,-0.8571429 -0.8571428,-1.7142857 -2.5714286,-3.42857143 -0.8571429,-2.57142857 0,-1.7142857 0.8571429,-2.5714286 1.7142857,-1.7142857 2.5714283,-0.8571429 3.428572,0 2.571428,0.8571429 1.714286,1.7142857 0.857143,2.5714286 0,1.7142857 -0.857143,2.57142857 -2.571429,3.42857143 -0.857142,1.7142857 0,0.8571429 0.857142,1.7142857 1.714286,0.8571428 0.857143,0 1.714286,-0.8571428 0.857143,-1.7142857 0,-0.8571429 -0.857143,-1.7142857 -1.714286,-0.8571429 -0.857143,0 -1.714286,0.8571429 m -10.2857139,-7.7142857 0.8571429,-1.7142857 1.7142857,-1.7142857 2.5714283,-0.8571429 3.428572,0 2.571428,0.8571429 1.714286,1.7142857 0.857143,1.7142857");				
      node.setAttribute("d", "m " + x + ", " + y + " c -2.3791,0 -4.7583,0 -7.1375,0 0,-0.625 0,-1.25 0,-1.875 1.4333,0 2.8667,0 4.3,0 -1.7672,-2.14662 -1.5685,-5.5656 0.4094,-7.51152 2.0181,-2.18368 5.6309,-2.60558 8.0906,-0.93221 1.9873,1.21173 3.127,3.66116 2.674,5.95888 -0.059,0.88801 -0.8073,1.93084 -1.0232,2.48485 1.3998,0 2.7995,0 4.1992,0 0,0.625 0,1.25 0,1.875 -2.3833,0 -4.7667,0 -7.15,0 0,-0.625 0,-1.25 0,-1.875 1.5522,-0.77524 2.4993,-2.60555 2.1062,-4.31561 -0.4463,-2.16745 -2.7982,-3.58998 -4.9369,-3.22969 -2.116,0.24112 -3.9706,2.2508 -3.6865,4.43437 0.1215,1.32077 1.0054,2.48975 2.1547,3.11093 0,0.625 0,1.25 0,1.875 z m -7.1375,5.625 c 0,-0.625 0,-1.25 0,-1.875 6.2167,0 12.4333,0 18.65,0 0,0.625 0,1.25 0,1.875 -6.2167,0 -12.4333,0 -18.65,0 z");	

			/* node.setAttribute("stroke", astrology.SIGNS_COLOR);		 
			node.setAttribute("stroke-width", astrology.SIGNS_STROKE);			

			//node.setAttribute("fill", "none");												
			node.setAttribute("fill", "black");												

            wrapper.appendChild(node); */
		
		    //Like the others
		    node.setAttribute("stroke", astrology.SIGNS_COLOR);					
			node.setAttribute("stroke-width", astrology.SIGNS_STROKE);			
			node.setAttribute("fill", astrology.SIGNS_COLOR); //"none");													
			wrapper.appendChild(node);
		    return wrapper;
	};

function libra( x, y ){

	// center symbol
	var xShift = 0; //px						
	var yShift = 0; //px		
	x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
	y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));
            console.log(x,y);
	
	var wrapper = document.createElementNS(context.root.namespaceURI, "g");
	wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
			
	var node = document.createElementNS( context.root.namespaceURI, "path");
    node.setAttribute("d", "m " + x+", " +y+ "  0 0c0-.271.01-.802.031-1.594 1.292-.583 1.938-1.562 1.938-2.937 0-.896-.312-1.635-.937-2.219-.604-.604-1.344-.906-2.219-.906-.896 0-1.635.302-2.219.906-.625.604-.937 1.354-.937 2.25 0 1.333.656 2.292 1.969 2.875l0 1.625-7.719 0 0-1.531c.875 0 2.625-.01 5.25-.031-.687-1-1.031-1.979-1.031-2.937 0-1.312.458-2.427 1.375-3.344s2.021-1.375 3.312-1.375c1.313 0 2.427.458 3.344 1.375.896 .917 1.344 2.031 1.344 3.344 0 .979-.333 1.969-1 2.969l5.25 0 0 1.531-7.75 0zm-10.094 4 0-1.562 17.844 0 0 1.563-17.844 0z");
	node.setAttribute("stroke", astrology.SIGNS_COLOR);		 
	node.setAttribute("stroke-width", astrology.SIGNS_STROKE);			
	//node.setAttribute("fill", "none");
	node.setAttribute("fill", astrology.SIGNS_COLOR);
	wrapper.appendChild(node);
										
	return wrapper;
};
	
	/*
	 * Scorpio symbol path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function scorpio( x, y ){

		// center symbol
		var xShift = -9; //px						
		var yShift = -4; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));
    	//x =  Math.round(x + (xShift * astrology.SIGN_SCALE));
		//y =  Math.round(y + (yShift * astrology.SIGN_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m " + x + ", " + y + " 2.3781101,-2.3781101 2.3781101,2.3781101 0,9.5124404 m -3.1708135,-11.0978471 2.3781101,2.3781101 0,8.719737 m 0.7927034,-9.5124404 2.3781101,-2.3781101 2.37811007,2.3781101 0,9.5124404 m -3.17081347,-11.0978471 2.3781101,2.3781101 0,8.719737 m 0.79270337,-9.5124404 2.37811013,-2.3781101 2.3781101,2.3781101 0,8.719737 1.5854067,1.5854068 m -4.7562202,-11.8905505 2.3781101,2.3781101 0,8.719737 1.5854067,1.5854067 2.3781101,-2.3781101");				
		node.setAttribute("stroke", astrology.SIGNS_COLOR);					
		node.setAttribute("stroke-width", astrology.SIGNS_STROKE);			
		node.setAttribute("fill", "none");													
		wrapper.appendChild(node);
		return wrapper;
	};

	/*
	 * Sagittarius symbol path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function sagittarius( x, y ){

		// center symbol
		var xShift = 7; //px						
		var yShift = -9; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));
		//x =  Math.round(x + (xShift * astrology.SIGN_SCALE));
		//y =  Math.round(y + (yShift * astrology.SIGN_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m " + x + ", " + y + " -17.11444,17.11444 m 17.11444,-17.11444 -3.2089575,1.0696525 -6.417915,0 m 7.4875675,1.0696525 -3.2089575,0 -4.27861,-1.0696525 m 9.6268725,-1.0696525 -1.0696525,3.2089575 0,6.41791504 m -1.0696525,-7.48756754 0,3.2089575 1.0696525,4.27861004 m -8.55722,0 -7.4875675,0 m 6.417915,1.06965246 -3.2089575,0 -3.2089575,-1.06965246 m 7.4875675,0 0,7.48756746 m -1.0696525,-6.417915 0,3.2089575 1.0696525,3.2089575");				
		node.setAttribute("stroke", astrology.SIGNS_COLOR);		 
		node.setAttribute("stroke-width", astrology.SIGNS_STROKE);			
		node.setAttribute("fill", "none");												
		wrapper.appendChild(node);	
		return wrapper;

	};

	/*
	 * Capricorn symbol path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function capricorn( x, y ){

		// center symbol
		var xShift = -9; //px						
		var yShift = -3; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));
		//x =  Math.round(x + (xShift * astrology.SIGN_SCALE));
		//y =  Math.round(y + (yShift * astrology.SIGN_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");		
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m " + x + ", " + y + " 1.8047633,-3.6095267 4.5119084,9.0238168 m -4.5119084,-7.2190534 4.5119084,9.0238167 2.707145,-6.3166717 4.5119084,0 2.707145,-0.9023817 0.9023817,-1.8047633 0,-1.8047634 -0.9023817,-1.8047633 -1.8047634,-0.9023817 -0.9023816,0 -1.8047634,0.9023817 -0.9023817,1.8047633 0,1.8047634 0.9023817,2.707145 0.9023817,1.80476336 0.9023817,2.70714504 0,2.707145 -1.8047634,1.8047633 m 1.8047634,-16.2428701 -0.9023817,0.9023817 -0.9023817,1.8047633 0,1.8047634 1.8047634,3.6095267 0.9023816,2.707145 0,2.707145 -0.9023816,1.8047634 -1.8047634,0.9023816");				
    	node.setAttribute("stroke", astrology.SIGNS_COLOR);		 
		node.setAttribute("stroke-width", astrology.SIGNS_STROKE);			
		node.setAttribute("fill", "none");												
		wrapper.appendChild(node);
		return wrapper;
	};

	/*
	 * Aquarius symbol path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function aquarius( x, y ){

		// center symbol
		var xShift = -8; //px						
		var yShift = -2; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));
		//x =  Math.round(x + (xShift * astrology.SIGN_SCALE));
		//y =  Math.round(y + (yShift * astrology.SIGN_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m " + x + ", " + y + " 2.8866035,-2.8866035 3.8488047,1.9244023 m -4.8110059,-0.9622011 3.8488047,1.9244023 2.8866035,-2.8866035 2.8866035,1.9244023 m -3.84880467,-0.9622011 2.88660347,1.9244023 2.8866035,-2.8866035 1.9244024,1.9244023 m -2.8866035,-0.9622011 1.9244023,1.9244023 2.8866035,-2.8866035 m -17.319621,8.6598105 2.8866035,-2.88660348 3.8488047,1.92440238 m -4.8110059,-0.96220121 3.8488047,1.92440231 2.8866035,-2.88660348 2.8866035,1.92440238 m -3.84880467,-0.96220121 2.88660347,1.92440231 2.8866035,-2.88660348 1.9244024,1.92440238 m -2.8866035,-0.96220121 1.9244023,1.92440231 2.8866035,-2.88660348");				
		node.setAttribute("stroke", astrology.SIGNS_COLOR);		 
		node.setAttribute("stroke-width", astrology.SIGNS_STROKE);			
		node.setAttribute("fill", "none");													
		wrapper.appendChild(node);
		return wrapper;
	};

	/*
	 * Pisces symbol path
	 * @private
	 * 
	 * @param {int} x
	 * @param {int} y	 
	 * 
	 * @return {SVGPathElement} path
	 */

	function pisces( x, y ){

		// center symbol
		var xShift = -8; //px						
		var yShift = -8; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));
		//x =  Math.round(x + (xShift * astrology.SIGN_SCALE));
		//y =  Math.round(y + (yShift * astrology.SIGN_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
    	wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m " + x + ", " + y + " 4,2 2,2 1,3 0,3 -1,3 -2,2 -4,2 m 0,-17 3,1 2,1 2,2 1,3 m 0,3 -1,3 -2,2 -2,1 -3,1 m 16,-17 -3,1 -2,1 -2,2 -1,3 m 0,3 1,3 2,2 2,1 3,1 m 0,-17 -4,2 -2,2 -1,3 0,3 1,3 2,2 4,2 m -17,-9 18,0 m -18,1 18,0");				
		node.setAttribute("stroke", astrology.SIGNS_COLOR);		 
		node.setAttribute("stroke-width", astrology.SIGNS_STROKE);			
		node.setAttribute("fill", "none");												
		wrapper.appendChild(node);
		return wrapper;
	};

	/**
	 * Draw As symbol
	 */

	function ascendant( x, y ){

		// center symbol
		var xShift = 12; //px						
		var yShift = -2; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m " + x + ", " + y + " -0.563078,-1.1261527 -1.689228,-0.5630765 -1.689229,0 -1.68923,0.5630765 -0.563076,1.1261527 0.563076,1.12615272 1.126154,0.56307636 2.815381,0.56307635 1.126152,0.56307647 0.563078,1.1261526 0,0.5630763 -0.563078,1.1261528 -1.689228,0.5630764 -1.689229,0 -1.68923,-0.5630764 -0.563076,-1.1261528 m -6.756916,-10.135374 -4.504611,11.8246032 m 4.504611,-11.8246032 4.504611,11.8246032 m -7.3199925,-3.94153457 5.6307625,0");									
		node.setAttribute("stroke", astrology.COLOR_ASC);//astrology.SYMBOL_AXIS_FONT_COLOR);		 
		node.setAttribute("stroke-width", astrology.SYMBOL_AXIS_STROKE);			
		node.setAttribute("fill", "none");	
		wrapper.appendChild(node);
		return wrapper;
	};

	/**
	 * Draw Ds symbol
	 */

	function descendant(x,y){

		// center symbol
		var xShift = 22; //px						
		var yShift = -1; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m " + x + ", " + y + " -0.5625,-1.125 -1.6875,-0.5625 -1.6875,0 -1.6875,0.5625 -0.5625,1.125 0.5625,1.125 1.125,0.5625 2.8125,0.5625 1.125,0.5625 0.5625,1.125 0,0.5625 -0.5625,1.125 -1.6875,0.5625 -1.6875,0 -1.6875,-0.5625 -0.5625,-1.125 m -11.25,-10.125 0,11.8125 m 0,-11.8125 3.9375,0 1.6875,0.5625 1.125,1.125 0.5625,1.125 0.5625,1.6875 0,2.8125 -0.5625,1.6875 -0.5625,1.125 -1.125,1.125 -1.6875,0.5625 -3.9375,0");				
		node.setAttribute("stroke", astrology.SYMBOL_AXIS_FONT_COLOR);		 
		node.setAttribute("stroke-width", astrology.SYMBOL_AXIS_STROKE);			
		node.setAttribute("fill", "none");											
		wrapper.appendChild(node);
		return wrapper;

	};

	/**
	 * Draw MC symbol
	 */

	function mediumCoeli(x,y){

		// center symbol
		var xShift = 19; //px						
		var yShift = -4; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m " + x + ", " + y + " -1.004085,-1.0040845 -1.004084,-0.5020423 -1.506127,0 -1.004085,0.5020423 -1.004084,1.0040845 -0.502043,1.50612689 0,1.00408458 0.502043,1.50612683 1.004084,1.0040846 1.004085,0.5020423 1.506127,0 1.004084,-0.5020423 1.004085,-1.0040846 m -17.57148,-9.0367612 0,10.5428881 m 0,-10.5428881 4.016338,10.5428881 m 4.016338,-10.5428881 -4.016338,10.5428881 m 4.016338,-10.5428881 0,10.5428881");				
		node.setAttribute("stroke", astrology.COLOR_MC);//astrology.SYMBOL_AXIS_FONT_COLOR);		 
		node.setAttribute("stroke-width", astrology.SYMBOL_AXIS_STROKE);			
		node.setAttribute("fill", "none");											
		wrapper.appendChild(node);
		return wrapper;

	};

	/**
	 * Draw IC symbol
	 */

	function immumCoeli(x,y){

		// center symbol
		var xShift = 19; //px						
		var yShift = 2; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m " + x + ", " + y + " -1.208852,-1.2088514 -1.208851,-0.6044258 -1.813278,0 -1.208852,0.6044258 -1.20885,1.2088514 -0.604426,1.81327715 0,1.20885135 0.604426,1.8132772 1.20885,1.2088513 1.208852,0.6044259 1.813278,0 1.208851,-0.6044259 1.208852,-1.2088513 m -11.4840902,-10.8796629 0,12.6929401");				
		node.setAttribute("stroke", astrology.SYMBOL_AXIS_FONT_COLOR);		 
		node.setAttribute("stroke-width", astrology.SYMBOL_AXIS_STROKE);		
		node.setAttribute("fill", "none");											
		wrapper.appendChild(node);
		return wrapper;

	};

	function number1(x,y){

		// center symbol
		var xShift = 0; //px						
		var yShift = -3; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " -2.5128753,7.7578884 1.00515009,0 m 3.01545031,-9.5832737 -1.0051501,1.8253853 -2.51287527,7.7578884 m 3.51802537,-9.5832737 -3.01545031,9.5832737 m 3.01545031,-9.5832737 -1.5077251,1.3690388 -1.50772521,0.9126929 -1.00515009,0.4563463 m 2.5128753,-0.9126927 -1.00515016,0.4563464 -1.50772514,0.4563463");			
		node.setAttribute("stroke", astrology.CUSPS_FONT_COLOR);		 
		node.setAttribute("stroke-width", astrology.CUSPS_STROKE);
		node.setAttribute("fill", "none");															
		wrapper.appendChild(node);
		return wrapper;

	};

	function number2(x,y){

		// center symbol
		var xShift = -2; //px						
		var yShift = -3; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " 0,-0.4545454 0.4545454,0 0,0.9090909 -0.9090909,0 0,-0.9090909 0.4545455,-0.9090909 0.4545454,-0.4545455 1.36363637,-0.4545454 1.36363633,0 1.3636364,0.4545454 0.4545455,0.9090909 0,0.9090909 -0.4545455,0.909091 -0.9090909,0.9090909 -4.5454546,2.72727269 -0.9090909,0.90909091 -0.9090909,1.8181818 m 6.8181818,-9.0909091 0.4545455,0.9090909 0,0.9090909 -0.4545455,0.909091 -0.9090909,0.9090909 -1.36363633,0.9090909 m 1.36363633,-5 0.4545455,0.4545454 0.4545454,0.9090909 0,0.9090909 -0.4545454,0.909091 -0.9090909,0.9090909 -3.6363637,2.72727269 m -1.3636363,1.81818181 0.4545454,-0.4545454 0.9090909,0 2.27272732,0.4545454 2.27272728,0 0.4545454,-0.4545454 m -5,0 2.27272732,0.9090909 2.27272728,0 m -4.5454546,-0.9090909 2.27272732,1.3636363 1.36363638,0 0.9090909,-0.4545454 0.4545454,-0.9090909 0,-0.4545455");			
		node.setAttribute("stroke", astrology.CUSPS_FONT_COLOR);		 
		node.setAttribute("stroke-width", astrology.CUSPS_STROKE);
		node.setAttribute("fill", "none");															
		wrapper.appendChild(node);
		return wrapper;

	};

	function number3(x,y){

		// center symbol
		var xShift = -2; //px						
		var yShift = -3; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");

		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " 0,-0.4545454 0.45454549,0 0,0.9090909 -0.90909089,0 0,-0.9090909 0.4545454,-0.9090909 0.45454549,-0.4545455 1.36363636,-0.4545454 1.36363635,0 1.3636364,0.4545454 0.4545454,0.9090909 0,0.9090909 -0.4545454,0.909091 -0.4545455,0.4545454 -0.9090909,0.4545455 -1.36363635,0.4545454 m 2.27272725,-4.0909091 0.4545455,0.9090909 0,0.9090909 -0.4545455,0.909091 -0.4545454,0.4545454 m -0.4545455,-3.6363636 0.4545455,0.4545454 0.4545454,0.9090909 0,0.9090909 -0.4545454,0.909091 -0.9090909,0.9090909 -0.90909095,0.4545454 m -0.9090909,0 0.9090909,0 1.36363635,0.4545455 0.4545455,0.45454542 0.4545454,0.90909091 0,1.36363637 -0.4545454,0.9090909 -0.9090909,0.4545455 -1.3636364,0.4545454 -1.3636364,0 -1.3636363,-0.4545454 -0.4545455,-0.4545455 -0.4545454,-0.9090909 0,-0.90909091 0.9090909,0 0,0.90909091 -0.4545455,0 0,-0.45454546 m 5,-1.81818182 0.4545455,0.90909091 0,1.36363637 -0.4545455,0.9090909 m -1.36363635,-4.0909091 0.90909095,0.4545455 0.4545454,0.90909088 0,1.81818182 -0.4545454,0.9090909 -0.45454549,0.4545455 -0.90909091,0.4545454");			
		node.setAttribute("stroke", astrology.CUSPS_FONT_COLOR);		 
		node.setAttribute("stroke-width", astrology.CUSPS_STROKE);
		node.setAttribute("fill", "none");															
		wrapper.appendChild(node);
		return wrapper;

	};

	function number4(x,y){

		// center symbol
		var xShift = 1; //px						
		var yShift = -4; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");

		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " -2.28678383,7.7750651 0.91471356,0 m 2.74414057,-9.6044922 -0.9147135,1.8294271 -2.28678386,7.7750651 m 3.20149736,-9.6044922 -2.74414057,9.6044922 m 2.74414057,-9.6044922 -7.3177083,6.8603516 7.3177083,0");			
		node.setAttribute("stroke", astrology.CUSPS_FONT_COLOR);		 
		node.setAttribute("stroke-width", astrology.CUSPS_STROKE);
		node.setAttribute("fill", "none");															
		wrapper.appendChild(node);
		return wrapper;

	};

	function number5(x,y){

		// center symbol
		var xShift = -2; //px						
		var yShift = -5; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");

		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " -2.27272725,4.5454545 m 2.27272725,-4.5454545 4.54545455,0 m -4.54545455,0.4545454 3.63636365,0 m -4.0909091,0.4545455 2.2727273,0 1.8181818,-0.4545455 0.9090909,-0.4545454 m -6.8181818,4.5454545 0.4545454,-0.4545454 1.3636364,-0.4545455 1.36363636,0 1.36363634,0.4545455 0.4545455,0.4545454 0.4545454,0.90909092 0,1.36363638 -0.4545454,1.3636364 -0.9090909,0.9090909 -1.81818185,0.4545454 -1.36363635,0 -0.9090909,-0.4545454 -0.4545455,-0.4545455 -0.4545454,-0.9090909 0,-0.9090909 0.9090909,0 0,0.9090909 -0.4545455,0 0,-0.45454545 m 5,-2.72727275 0.4545455,0.90909092 0,1.36363638 -0.4545455,1.3636364 -0.9090909,0.9090909 m -0.45454544,-5.4545455 0.90909094,0.4545455 0.4545454,0.9090909 0,1.8181818 -0.4545454,1.3636364 -0.90909094,0.9090909 -0.90909091,0.4545454");			
		node.setAttribute("stroke", astrology.CUSPS_FONT_COLOR);		 
		node.setAttribute("stroke-width", astrology.CUSPS_STROKE);
		node.setAttribute("fill", "none");															
		wrapper.appendChild(node);
		return wrapper;
	};

	function number6(x,y){

		// center symbol
		var xShift = 3; //px						
		var yShift = -3; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");

		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " 0,-0.4545455 -0.4545455,0 0,0.9090909 0.9090909,0 0,-0.9090909 -0.4545454,-0.9090909 -0.909091,-0.4545454 -1.3636363,0 -1.36363638,0.4545454 -0.90909092,0.9090909 -0.9090909,1.3636364 -0.4545455,1.3636364 -0.4545454,1.81818178 0,1.36363636 0.4545454,1.36363636 0.4545455,0.4545455 0.9090909,0.4545454 1.36363637,0 1.36363633,-0.4545454 0.9090909,-0.9090909 0.4545455,-0.90909096 0,-1.36363636 -0.4545455,-0.90909088 -0.4545454,-0.4545455 -0.9090909,-0.4545454 -1.36363638,0 -0.90909092,0.4545454 -0.4545454,0.4545455 -0.4545455,0.90909088 m 1.36363636,-4.54545458 -0.90909086,1.3636364 -0.4545455,1.3636364 -0.4545455,1.81818178 0,1.81818182 0.4545455,0.9090909 m 4.0909091,-0.4545454 0.4545454,-0.90909096 0,-1.36363636 -0.4545454,-0.90909088 m -0.9090909,-5 -0.90909093,0.4545454 -0.90909091,1.3636364 -0.45454546,0.9090909 -0.4545454,1.3636364 -0.4545455,1.81818178 0,2.27272732 0.4545455,0.9090909 0.4545454,0.4545454 m 1.36363637,0 0.90909093,-0.4545454 0.4545454,-0.4545455 0.4545455,-1.36363636 0,-1.81818182 -0.4545455,-0.90909092 -0.4545454,-0.4545454");			
		node.setAttribute("stroke", astrology.CUSPS_FONT_COLOR);		 
		node.setAttribute("stroke-width", astrology.CUSPS_STROKE);
		node.setAttribute("fill", "none");															
		wrapper.appendChild(node);
		return wrapper;

	};


	function number7(x,y){

		// center symbol
		var xShift = -4; //px						
		var yShift = -4; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");

		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " -0.9090909,2.7272727 m 6.8181818,-2.7272727 -0.4545454,1.3636363 -0.909091,1.3636364 -1.8181818,2.2727273 -0.90909088,1.36363633 -0.45454546,1.36363637 -0.45454545,1.8181818 m 0.90909091,-3.63636362 -0.90909091,1.81818182 -0.45454546,1.8181818 m 4.09090905,-6.8181818 -2.72727268,2.72727272 -0.90909091,1.36363637 -0.45454546,0.90909091 -0.45454545,1.8181818 0.90909091,0 m -1.36363641,-8.1818182 1.36363641,-1.3636363 0.90909091,0 2.27272728,1.3636363 m -3.63636365,-0.9090909 1.36363637,0 2.27272728,0.9090909 m -4.5454546,0 0.90909095,-0.4545454 1.36363637,0 2.27272728,0.4545454 0.9090909,0 0.4545455,-0.4545454 0.4545454,-0.9090909");			
		node.setAttribute("stroke", astrology.CUSPS_FONT_COLOR);		 
		node.setAttribute("stroke-width", astrology.CUSPS_STROKE);
		node.setAttribute("fill", "none");															
		wrapper.appendChild(node);
		return wrapper;

	};

	function number8(x,y){

		// center symbol
		var xShift = -1; //px						
		var yShift = -5; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));
		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");

		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " -1.3631244,0.4543748 -0.4543748,0.4543748 -0.4543748,0.9087496 0,1.3631244 0.4543748,0.9087496 0.9087496,0.4543748 1.3631244,0 1.3631244,-0.4543748 0.9087496,-0.4543748 0.4543748,-0.9087496 0,-1.3631244 -0.4543748,-0.9087496 -0.9087496,-0.4543748 -1.8174992,0 m 0.9087496,0 -2.271874,0.4543748 m 0,0.4543748 -0.4543748,0.9087496 0,1.8174992 0.4543748,0.4543748 m -0.4543748,0 1.3631244,0.4543748 m 0.4543748,0 1.8174992,-0.4543748 m 0.4543748,-0.4543748 0.4543748,-0.9087496 0,-1.3631244 -0.4543748,-0.9087496 m 0.4543748,0 -1.8174992,-0.4543748 m -0.9087496,0 -0.9087496,0.9087496 -0.4543748,0.9087496 0,1.8174992 0.4543748,0.9087496 m 1.3631244,0 0.9087496,-0.4543748 0.4543748,-0.4543748 0.4543748,-0.9087496 0,-1.8174992 -0.4543748,-0.9087496 m -2.7262488,4.543748 -1.8174992,0.4543748 -0.9087496,0.90874964 -0.4543748,0.9087496 0,1.36312436 0.4543748,0.9087496 1.3631244,0.4543748 1.8174992,0 1.8174992,-0.4543748 0.4543748,-0.4543748 0.4543748,-0.9087496 0,-1.36312436 -0.4543748,-0.9087496 -0.4543748,-0.45437484 -0.9087496,-0.4543748 m -0.9087496,0 -2.271874,0.4543748 m 0.4543748,0 -0.9087496,0.90874964 -0.4543748,0.9087496 0,1.36312436 0.4543748,0.9087496 m -0.4543748,0 2.271874,0.4543748 2.7262488,-0.4543748 m 0,-0.4543748 0.4543748,-0.9087496 0,-1.36312436 -0.4543748,-0.9087496 m 0,-0.45437484 -1.3631244,-0.4543748 m -0.9087496,0 -0.9087496,0.4543748 -0.9087496,0.90874964 -0.4543748,0.9087496 0,1.36312436 0.4543748,0.9087496 0.4543748,0.4543748 m 1.8174992,0 0.9087496,-0.4543748 0.4543748,-0.4543748 0.4543748,-0.9087496 0,-1.81749916 -0.4543748,-0.90874964 -0.4543748,-0.4543748");			
		node.setAttribute("stroke", astrology.CUSPS_FONT_COLOR);		 
		node.setAttribute("stroke-width", astrology.CUSPS_STROKE);
		node.setAttribute("fill", "none");															
		wrapper.appendChild(node);
		return wrapper;

	};

	function number9(x,y){

		// center symbol
		var xShift = 1; //px						
		var yShift = -2; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");

		var node = document.createElementNS( context.root.namespaceURI, "path");
		node.setAttribute("d", "m" + x + ", " + y + " -0.4545455,0.9090909 -0.4545454,0.4545455 -0.9090909,0.45454542 -1.36363638,0 -0.90909092,-0.45454542 -0.4545454,-0.4545455 -0.4545455,-0.9090909 0,-1.3636364 0.4545455,-0.9090909 0.90909086,-0.9090909 1.36363637,-0.4545454 1.36363637,0 0.9090909,0.4545454 0.4545455,0.4545455 0.4545454,1.3636363 0,1.3636364 -0.4545454,1.81818182 -0.4545455,1.36363637 -0.9090909,1.36363641 -0.9090909,0.9090909 -1.36363638,0.4545454 -1.36363632,0 -0.909091,-0.4545454 -0.4545454,-0.9090909 0,-0.90909096 0.9090909,0 0,0.90909096 -0.4545455,0 0,-0.4545455 m 1.3636364,-3.1818182 -0.4545454,-0.9090909 0,-1.3636364 0.4545454,-0.9090909 m 4.0909091,-0.4545454 0.4545455,0.9090909 0,1.8181818 -0.4545455,1.81818182 -0.4545455,1.36363637 -0.9090909,1.36363641 m -1.81818178,-2.72727278 -0.45454546,-0.45454542 -0.45454546,-0.9090909 0,-1.8181819 0.45454546,-1.3636363 0.45454546,-0.4545455 0.90909091,-0.4545454 m 1.36363637,0 0.4545454,0.4545454 0.4545455,0.9090909 0,2.2727273 -0.4545455,1.81818182 -0.4545454,1.36363637 -0.4545455,0.90909091 -0.90909087,1.3636364 -0.90909091,0.4545454");			
		node.setAttribute("stroke", astrology.CUSPS_FONT_COLOR);		 
		node.setAttribute("stroke-width", astrology.CUSPS_STROKE);
		node.setAttribute("fill", "none");															
		wrapper.appendChild(node);
		return wrapper;

	};

	function number10(x,y){

		// center symbol
		var xShift = -3; //px						
		var yShift = -3.5; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

	    var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");

		var one = document.createElementNS( context.root.namespaceURI, "path");
		one.setAttribute("d", "m" + x + ", " + y + " -2.28795747,7.7790553 0.91518297,0 m 2.7455489,-9.6094213 -0.9151829,1.830366 -2.28795748,7.7790553 m 3.20314038,-9.6094213 -2.7455489,9.6094213 m 2.7455489,-9.6094213 -1.3727744,1.3727745 -1.3727745,0.915183 -0.91518297,0.4575915 m 2.28795747,-0.915183 -0.91518301,0.4575915 -1.37277446,0.4575915");			
		one.setAttribute("stroke", astrology.CUSPS_FONT_COLOR);		 
		one.setAttribute("stroke-width", astrology.CUSPS_STROKE);
		one.setAttribute("fill", "none");															
		wrapper.appendChild(one);

		var numberXShift = 6.5; //px						
		var numberYShift = -1.5; //px
		var zero = document.createElementNS( context.root.namespaceURI, "path");
		zero.setAttribute("d", "m" + (x + numberXShift) + ", " + (y + numberYShift) + " -1.36363638,0.4545454 -0.90909092,0.9090909 -0.9090909,1.3636364 -0.4545455,1.3636364 -0.4545454,1.81818178 0,1.36363636 0.4545454,1.36363636 0.4545455,0.4545455 0.9090909,0.4545454 0.90909092,0 1.36363638,-0.4545454 0.9090909,-0.9090909 0.9090909,-1.36363641 0.4545455,-1.36363637 0.4545454,-1.81818182 0,-1.3636364 -0.4545454,-1.3636363 -0.4545455,-0.4545455 -0.9090909,-0.4545454 -0.9090909,0 m -1.36363638,0.9090909 -0.90909092,0.9090909 -0.4545454,0.9090909 -0.4545455,1.3636364 -0.4545455,1.81818178 0,1.81818182 0.4545455,0.9090909 m 3.1818182,0 0.9090909,-0.9090909 0.4545454,-0.90909091 0.4545455,-1.36363637 0.4545455,-1.81818182 0,-1.8181818 -0.4545455,-0.9090909 m -1.8181818,-0.9090909 -0.90909093,0.4545454 -0.90909091,1.3636364 -0.45454546,0.9090909 -0.4545454,1.3636364 -0.4545455,1.81818178 0,2.27272732 0.4545455,0.9090909 0.4545454,0.4545454 m 0.90909092,0 0.90909091,-0.4545454 0.90909087,-1.3636364 0.4545455,-0.90909091 0.4545454,-1.36363637 0.4545455,-1.81818182 0,-2.2727273 -0.4545455,-0.9090909 -0.4545454,-0.4545454");
		zero.setAttribute("stroke", astrology.CUSPS_FONT_COLOR);		 
		zero.setAttribute("stroke-width", astrology.CUSPS_STROKE);
		zero.setAttribute("fill", "none");												
		wrapper.appendChild( zero );
		return wrapper;

	};

	function number11(x,y){

		// center symbol
		var xShift = -3; //px						
		var yShift = -3; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

		var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");
		var one = document.createElementNS( context.root.namespaceURI, "path");
		one.setAttribute("d", "m" + x + ", " + y + " -2.28795747,7.7790553 0.91518297,0 m 2.7455489,-9.6094213 -0.9151829,1.830366 -2.28795748,7.7790553 m 3.20314038,-9.6094213 -2.7455489,9.6094213 m 2.7455489,-9.6094213 -1.3727744,1.3727745 -1.3727745,0.915183 -0.91518297,0.4575915 m 2.28795747,-0.915183 -0.91518301,0.4575915 -1.37277446,0.4575915");			
		one.setAttribute("stroke", astrology.CUSPS_FONT_COLOR);		 
		one.setAttribute("stroke-width", astrology.CUSPS_STROKE);
		one.setAttribute("fill", "none");															
		wrapper.appendChild(one);

		var numberXShift = 6; //px						
		var numberYShift = 0; //px
		var one2 = document.createElementNS( context.root.namespaceURI, "path");
		one2.setAttribute("d", "m" + (x + numberXShift) + ", " + (y + numberYShift) + " -2.28795747,7.7790553 0.91518297,0 m 2.7455489,-9.6094213 -0.9151829,1.830366 -2.28795748,7.7790553 m 3.20314038,-9.6094213 -2.7455489,9.6094213 m 2.7455489,-9.6094213 -1.3727744,1.3727745 -1.3727745,0.915183 -0.91518297,0.4575915 m 2.28795747,-0.915183 -0.91518301,0.4575915 -1.37277446,0.4575915");
		one2.setAttribute("stroke", astrology.CUSPS_FONT_COLOR);		 
		one2.setAttribute("stroke-width", astrology.CUSPS_STROKE);
		one2.setAttribute("fill", "none");												
		wrapper.appendChild( one2 );
		return wrapper;

	};

	function number12(x,y){

		// center symbol
		var xShift = -3; //px						
		var yShift = -3; //px		
		x =  Math.round(x + (xShift * astrology.SYMBOL_SCALE));
		y =  Math.round(y + (yShift * astrology.SYMBOL_SCALE));

	    var wrapper = document.createElementNS(context.root.namespaceURI, "g");
		wrapper.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");

		var one = document.createElementNS( context.root.namespaceURI, "path");
		one.setAttribute("d", "m" + x + ", " + y + " -2.28795747,7.7790553 0.91518297,0 m 2.7455489,-9.6094213 -0.9151829,1.830366 -2.28795748,7.7790553 m 3.20314038,-9.6094213 -2.7455489,9.6094213 m 2.7455489,-9.6094213 -1.3727744,1.3727745 -1.3727745,0.915183 -0.91518297,0.4575915 m 2.28795747,-0.915183 -0.91518301,0.4575915 -1.37277446,0.4575915");			
		one.setAttribute("stroke", astrology.CUSPS_FONT_COLOR);		 
		one.setAttribute("stroke-width", astrology.CUSPS_STROKE);
		one.setAttribute("fill", "none");															
		wrapper.appendChild(one);

		var numberXShift = 4; //px						
		var numberYShift = 1; //px
		var two = document.createElementNS( context.root.namespaceURI, "path");
		two.setAttribute("d", "m" + (x + numberXShift) + ", " + (y + numberYShift) + " 0,-0.4545454 0.4545454,0 0,0.9090909 -0.9090909,0 0,-0.9090909 0.4545455,-0.9090909 0.4545454,-0.4545455 1.36363637,-0.4545454 1.36363633,0 1.3636364,0.4545454 0.4545455,0.9090909 0,0.9090909 -0.4545455,0.909091 -0.9090909,0.9090909 -4.5454546,2.72727269 -0.9090909,0.90909091 -0.9090909,1.8181818 m 6.8181818,-9.0909091 0.4545455,0.9090909 0,0.9090909 -0.4545455,0.909091 -0.9090909,0.9090909 -1.36363633,0.9090909 m 1.36363633,-5 0.4545455,0.4545454 0.4545454,0.9090909 0,0.9090909 -0.4545454,0.909091 -0.9090909,0.9090909 -3.6363637,2.72727269 m -1.3636363,1.81818181 0.4545454,-0.4545454 0.9090909,0 2.27272732,0.4545454 2.27272728,0 0.4545454,-0.4545454 m -5,0 2.27272732,0.9090909 2.27272728,0 m -4.5454546,-0.9090909 2.27272732,1.3636363 1.36363638,0 0.9090909,-0.4545454 0.4545454,-0.9090909 0,-0.4545455");
		two.setAttribute("stroke", astrology.CUSPS_FONT_COLOR);		 
		two.setAttribute("stroke-width", astrology.CUSPS_STROKE);
		two.setAttribute("fill", "none");												
		wrapper.appendChild( two );
		return wrapper;

	};	

	/**
	 * Draw circular sector
	 * 
	 * @param {int} x - circle x center position
	 * @param {int} y - circle y center position
	 * @param {int} radius - circle radius in px
	 * @param {int} a1 - angleFrom in degree
	 * @param {int} a2 - angleTo in degree
	 * @param {int} thickness - from outside to center in px  	
	 * 
	 * @return {SVGElement} segment
	 *  
	 * @see SVG Path arc: https://www.w3.org/TR/SVG/paths.html#PathData
	 */  

	astrology.SVG.prototype.segment = function segment( x, y, radius, a1, a2, thickness, lFlag, sFlag){

	 	// @see SVG Path arc: https://www.w3.org/TR/SVG/paths.html#PathData
	 	var LARGE_ARC_FLAG = lFlag || 0;
	 	var SWEET_FLAG = sFlag || 0;

        a1 = ((astrology.SHIFT_IN_DEGREES - a1) % 360) * Math.PI / 180;
        a2 = ((astrology.SHIFT_IN_DEGREES - a2 ) % 360) * Math.PI / 180;

		var segment = document.createElementNS( context.root.namespaceURI, "path");
		segment.setAttribute("d", "M " + (x + thickness * Math.cos(a1)) + ", " + (y + thickness * Math.sin(a1)) + " l " + ((radius-thickness) * Math.cos(a1)) + ", " + ((radius-thickness) * Math.sin(a1)) + " A " + radius + ", " + radius + ",0 ," +  LARGE_ARC_FLAG + ", " + SWEET_FLAG + ", " + ( x + radius * Math.cos(a2) ) + ", " + ( y + radius * Math.sin(a2) ) + " l " + ( (radius-thickness)  * -Math.cos(a2) ) + ", " + ( (radius-thickness) * -Math.sin(a2) ) + " A " + thickness + ", " + thickness + ",0 ," +  LARGE_ARC_FLAG + ", " + 1 + ", " + ( x + thickness * Math.cos(a1) ) + ", " + ( y + thickness * Math.sin(a1)));
		segment.setAttribute("fill", "none");						
		return segment;
	};

	/**
	 * Draw line in circle
	 * 
	 * @param {int} x1
	 * @param {int} y2
	 * @param {int} x2
	 * @param {int} y2 
	 * @param {String} color - HTML rgb	 
	 * 
	 * @return {SVGElement} line
	 */  

	astrology.SVG.prototype.line = function line( x1, y1, x2, y2, color){									            	 	            	

    	var line = document.createElementNS( context.root.namespaceURI, "line");
		line.setAttribute("x1", x1);
		line.setAttribute("y1", y1);	
  	    line.setAttribute("x2", x2);
		line.setAttribute("y2", y2);											
		return line;
	};

	/**
	 * Draw a circle
	 * 
	 * @param {int} cx
	 * @param {int} cy
	 * @param {int} radius	
	 * 
	 * @return {SVGElement} circle
	 */  

	astrology.SVG.prototype.circle = function circle( cx, cy, radius){						            	 	            		

		var circle = document.createElementNS( context.root.namespaceURI, "circle");
		circle.setAttribute("cx", cx);	
  	    circle.setAttribute("cy", cy);
		circle.setAttribute("r", radius);
		circle.setAttribute("fill", "none");							
		return circle;

	};

	/**
	 * Draw a text
	 * 
	 * @param {String} text
	 * @param {int} x
	 * @param {int} y
	 * @param {String} size - etc. "13px"
	 * @param {String} color - HTML rgb
	 * 
	 * @return {SVGElement} text
	 */  

	astrology.SVG.prototype.text = function text( txt, x, y, size, color){						            	 	            		

    	var text = document.createElementNS( context.root.namespaceURI, "text");
		text.setAttribute("x", x);	
  	    text.setAttribute("y", y);
		text.setAttribute("font-size", size);
		text.setAttribute("fill", color);
		text.setAttribute("font-family", "serif");
		text.setAttribute("dominant-baseline", "central");
		text.appendChild( document.createTextNode( txt ));
		text.setAttribute("transform", "translate(" + ( -x * (astrology.SYMBOL_SCALE - 1)) + "," + (-y * (astrology.SYMBOL_SCALE - 1)) + ") scale(" + astrology.SYMBOL_SCALE + ")");	
		return text;
	};


}( window.astrology = window.astrology || {}));

// ## CHART ###################################

(function( astrology ) {

	/**
	 * Displays astrology charts.
	 * 
	 * @class
	 * @public
	 * @constructor
 	 * @param {String} elementId - root DOMElement 
	 * @param {int} width
	 * @param {int} height
	 * @param {Object} settings
	 */

	astrology.Chart = function( elementId, width, height, settings ){


		if(settings){
			Object.assign(astrology, settings);
		}

		if (elementId && !document.getElementById( elementId )){

			var paper = document.createElement('div');					
			paper.setAttribute('id', elementId);			
			document.body.appendChild( paper );
		}

		this.paper = new astrology.SVG( elementId, width, height); 
		this.cx = this.paper.width/2;
		this.cy = this.paper.height/2;
		this.radius = this.paper.height/2 - astrology.MARGIN;
		return this;

	};

	/**
	 * Display radix horoscope
	 * 
	 * @param {Object} data
	 * @example
	 *	{
	 *		"points":{"Moon":[0], "Sun":[30],  ... },
	 *		"cusps":[300, 340, 30, 60, 75, 90, 116, 172, 210, 236, 250, 274] 
	 *	}
	 * 
	 * @see https://github.com/Kibo/AstroWebService 
	 * 
	 * @return {astrology.Radix} radix
	 */

	astrology.Chart.prototype.radix = function( data ){

		var radix = new astrology.Radix(this.paper, this.cx, this.cy, this.radius, data);
		radix.drawBg();				
		radix.drawUniverse();									
		radix.drawRuler();									
		radix.drawPoints();
		radix.drawCusps();		
		radix.drawAxis();	 
		radix.drawCircles();
		return radix;

	 };

	 /**
	 * Scale chart
	 * 
	 * @param {int} factor 
	 */

	astrology.Chart.prototype.scale = function( factor ){			

    	this.paper.root.setAttribute("transform", "translate(" + ( -this.cx * (factor - 1)) + "," + (-this.cy * (factor - 1)) + ") scale(" + factor + ")");		

	};

	/**
	 * Draw the symbol on the axis.
	 * For debug only.
	 * 	
	 */

	astrology.Chart.prototype.calibrate = function calibrate(){

		var positions, circle, line;
		var startRadius = 60;
		var planets = ["Sun", "Moon", "Mercury", "Venus", "Mars", "Jupiter", "Saturn", "Uranus", "Neptune", "Pluto", "Chiron", "Lilith", "NNode"];

		for(var i = 0; i < planets.length; i++){		

			positions = astrology.utils.getPointPosition(this.cx, this.cy, this.radius*2, i * 30 );
			line = this.paper.line(this.cx, this.cy, positions.x, positions.y);
			line.setAttribute("stroke", astrology.LINE_COLOR);	
			this.paper.root.appendChild( line);

			circle = this.paper.circle(this.cx, this.cy, startRadius + startRadius * i );
			circle.setAttribute("stroke", astrology.LINE_COLOR);		 
			circle.setAttribute("stroke-width", 1);
			this.paper.root.appendChild( circle );

		}

		for(var n = 0, ln = planets.length; n < ln; n++){

			var radius = startRadius + startRadius*n; 

			for(var i = 0; i < 12; i++){

				positions = astrology.utils.getPointPosition(this.cx, this.cy, radius, i * 30 );			
				circle = this.paper.circle(positions.x, positions.y, astrology.COLLISION_RADIUS *astrology.SYMBOL_SCALE );
				circle.setAttribute("stroke", "red");		 
				circle.setAttribute("stroke-width", 1);
				this.paper.root.appendChild( circle );							
				this.paper.root.appendChild( this.paper.getSymbol( planets[n], positions.x, positions.y));	

			}

		}

		return this;		
	};


}( window.astrology = window.astrology || {}));

// ## Radix chart ###################################

(function( astrology ) {

	var context;

	/**
	 * Radix charts.
	 * 
	 * @class
	 * @public
	 * @constructor
 	 * @param {astrology.SVG} paper 
	 * @param {int} cx
	 * @param {int} cy
	 * @param {int} radius
	 * @param {Object} data
	 */

	    astrology.Radix = function( paper, cx, cy, radius, data ){

        // Validate data
        var status = astrology.utils.validate(data);		 		


		if( status.hasError ) {										
			throw new Error( status.messages );
		}

		this.data = data;								
		this.paper = paper; 
		this.cx = cx;
		this.cy = cy;
		this.radius = radius;
		
		//this.SHOW_INNER_CIRCLE = data.SHOW_INNER_CIRCLE;
		//this.COLOR_INNER_CIRCLE = "#00ff00";
		
		
	/* astrology.COLOR_ARIES = astrology.COLORS_USER[0];
	astrology.COLOR_TAURUS = astrology.COLORS_USER[1];
	astrology.COLOR_GEMINI= astrology.COLORS_USER[2];
	astrology.COLOR_CANCER = astrology.COLORS_USER[3]; 
	astrology.COLOR_LEO = astrology.COLORS_USER[4]; 
	astrology.COLOR_VIRGO = astrology.COLORS_USER[5]; 
	astrology.COLOR_LIBRA = astrology.COLORS_USER[6];  
	astrology.COLOR_SCORPIO = astrology.COLORS_USER[7];  
	astrology.COLOR_SAGITTARIUS = astrology.COLORS_USER[8];
	astrology.COLOR_CAPRICORN = astrology.COLORS_USER[9]; 
	astrology.COLOR_AQUARIUS = astrology.COLORS_USER[10]; 
	astrology.COLOR_PISCES = astrology.COLORS_USER[11];
	astrology.COLOR_SUN = astrology.COLORS_USER[12];
	astrology.COLOR_MOON = astrology.COLORS_USER[13];
	astrology.COLOR_MERCURY = astrology.COLORS_USER[14];
	astrology.COLOR_VENUS = astrology.COLORS_USER[15];
	astrology.COLOR_MARS = astrology.COLORS_USER[16];
	astrology.COLOR_JUPITER = astrology.COLORS_USER[17];
	astrology.COLOR_SATURN = astrology.COLORS_USER[18];
	astrology.COLOR_URANUS = astrology.COLORS_USER[19];
	astrology.COLOR_NEPTUNE = astrology.COLORS_USER[20];
	astrology.COLOR_PLUTO = astrology.COLORS_USER[21];
	astrology.COLOR_ASC = astrology.COLORS_USER[22];
	astrology.COLOR_MC = astrology.COLORS_USER[23];
	astrology.COLOR_PLANETS = astrology.COLORS_USER[24];
	astrology.COLOR_BACKGROUND = astrology.COLORS_USER[25];
	astrology.SHOW_INNER_CIRCLE = astrology.COLORS_USER[26];
	astrology.COLOR_INNER_BACKGROUND = astrology.COLORS_USER[27];
	astrology.COLOR_INNER_CIRCLE = astrology.COLOR_INNER_BACKGROUND;
	var fire = astrology.COLORS_USER[28];
	var earth = astrology.COLORS_USER[29];
	var air = astrology.COLORS_USER[30];
	var water = astrology.COLORS_USER[31];
	var same_color = astrology.COLORS_USER[32];
    astrology.COLOR_SIGNS = [fire,earth,air,water,fire,earth,air,water,fire,earth,air,water,fire,earth,air,water]; */
	/* Uncomment next for same color for all the sign glyphs */
	// astrology.COLOR_SIGNS = [same_color,same_color,same_color,same_color,same_color,same_color,same_color,same_color,same_color,same_color,same_color,same_color];
		/* for(i=0;i<33;i++){
			console.log("" + i + ": " + astrology.COLORS_USER[i] + "\n");
		} */


		// after calling this.drawPoints() it contains current position of point


		this.locatedPoints = [];
		this.rulerRadius = ((this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO)/astrology.RULER_RADIUS);
		this.pointRadius = this.radius - (this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO + 2*this.rulerRadius + astrology.PADDING);

		//@see astrology.Radix.prototype.aspects()
		//@see astrology.Radix.prototype.setPointsOfInterest() 

        this.toPoints = this.data.planets;
		this.shift = 0;		

		if(this.data.cusps && this.data.cusps[0]){

			var deg360 = astrology.utils.radiansToDegree(2*Math.PI);
			this.shift = deg360 - this.data.cusps[0];	

		}	

		// preparing wrapper for aspects. It is the lowest layer
		var divisionForAspects = document.createElementNS(this.paper.root.namespaceURI, "g");
		divisionForAspects.setAttribute('id', astrology.ID_CHART + "-" + astrology.ID_ASPECTS);
		this.paper.root.appendChild( divisionForAspects );
		this.universe = document.createElementNS(this.paper.root.namespaceURI, "g");
		this.universe.setAttribute('id', astrology.ID_CHART + "-" + astrology.ID_RADIX);
		this.paper.root.appendChild( this.universe );

		context = this;
		return this;

	};

	/**
	 * Draw background
	 */

	astrology.Radix.prototype.drawBg = function(){				

		var universe = this.universe;	
		var wrapper = astrology.utils.getEmptyWrapper( universe, astrology.ID_CHART + "-" + astrology.ID_BG);	

		var LARGE_ARC_FLAG = 1;	
		var start = 0; //degree
		var end = 359.99; //degree 				
		var hemisphere = this.paper.segment( this.cx, this.cy, this.radius-this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO, start, end, this.radius/astrology.INDOOR_CIRCLE_RADIUS_RATIO, LARGE_ARC_FLAG);

		hemisphere.setAttribute("fill", astrology.STROKE_ONLY ? "none" : astrology.COLOR_BACKGROUND);				
		wrapper.appendChild( hemisphere );					

	};

	/**
	 * Draw universe.
	 */

	astrology.Radix.prototype.drawUniverse = function(){

		var universe = this.universe;		
		var wrapper = astrology.utils.getEmptyWrapper( universe, astrology.ID_CHART + "-" + astrology.ID_RADIX + "-" + astrology.ID_SIGNS);

		// colors 

        for( var i = 0, step = 30, start = this.shift, len = astrology.COLORS_SIGNS.length; i < len; i++ ){ 

        	var segment = this.paper.segment( this.cx, this.cy, this.radius, start, start+step, this.radius-this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO);        	        	
        	segment.setAttribute("fill", astrology.STROKE_ONLY ? "none" : astrology.COLORS_SIGNS[i]);        	        	        	
            //Astroworld
        	//segment.setAttribute("stroke", astrology.STROKE_ONLY ? astrology.CIRCLE_COLOR: "none");
        	segment.setAttribute("stroke", "black");		 				 				 		
 			segment.setAttribute("stroke-width", astrology.STROKE_ONLY ? 2 : 2); //1:0 				
        	wrapper.appendChild( segment );
			start += step;

        };

        // signs

        for( var i = 0, step = 30, start = 15 + this.shift, len = astrology.SYMBOL_SIGNS.length; i < len; i++ ){ 

        	var position = astrology.utils.getPointPosition( this.cx, this.cy, this.radius - (this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO)/2, start);       	        	                	
        	wrapper.appendChild( this.paper.getSymbol( astrology.SYMBOL_SIGNS[i], position.x, position.y));        	        	        	               		
			start += step;

        }        

	};

/* SORT */
if( typeof helper == 'undefined' ) {
  var helper = { } ;
}
helper.arr = {
     /**
     * Function to sort multidimensional array
     * 
     * param {array} [arr] Source array
     * param {array} [columns] List of columns to sort
     * param {array} [order_by] List of directions (ASC, DESC)
     * returns {array}
     */
    multisort: function(arr, columns, order_by) {
        if(typeof columns == 'undefined') {
            columns = []
            for(x=0;x<arr[0].length;x++) {
                columns.push(x);
            }
        }

        if(typeof order_by == 'undefined') {
            order_by = []
            for(x=0;x<arr[0].length;x++) {
                order_by.push('ASC');
            }
        }

        function multisort_recursive(a,b,columns,order_by,index) {  
            var direction = order_by[index] == 'DESC' ? 1 : 0;

            var is_numeric = !isNaN(a[columns[index]]-b[columns[index]]);

            var x = is_numeric ? a[columns[index]] : a[columns[index]].toLowerCase();
            var y = is_numeric ? b[columns[index]] : b[columns[index]].toLowerCase();

            if(!is_numeric) {
                x = helper.string.to_ascii(a[columns[index]].toLowerCase(),-1),
                y = helper.string.to_ascii(b[columns[index]].toLowerCase(),-1);
            }

            if(x < y) {
                    return direction == 0 ? -1 : 1;
            }

            if(x == y)  {
                return columns.length-1 > index ? multisort_recursive(a,b,columns,order_by,index+1) : 0;
            }

            return direction == 0 ? 1 : -1;
        }

        return arr.sort(function (a,b) {
            return multisort_recursive(a,b,columns,order_by,0);
        });
    }
}
function getSortedKeys(obj) {
    var keys = keys = Object.keys(obj);
    return keys.sort(function(a,b){return obj[b]-obj[a]});
}
	
function sortKeys(obj_1) { 
            var key = Object.keys(obj_1) 
            .sort(function order(key1, key2) { 
                if (key1 < key2) return -1; 
                else if (key1 > key2) return +1; 
                else return 0; 
            });  
              
            // Taking the object in 'temp' object 
            // and deleting the original object. 
            var temp = {}; 
              
            for (var i = 0; i < key.length; i++) { 
                temp[key[i]] = obj_1[key[i]]; 
                delete obj_1[key[i]]; 
            }  
  
            // Copying the object from 'temp' to  
            // 'original object'. 
            for (var i = 0; i < key.length; i++) { 
                obj_1[key[i]] = temp[key[i]]; 
            }  
            return obj_1; 
        } 
// ---
// Sort functions...
function array_sort( arrayIn ) {

	var arrayCouplets = new Array();
	for( key in arrayIn ) {

		arrayCouplets.push({
			key: key,
			value: arrayIn[ key ]
		});
		console.log(arrayIn[ key ]);
	}

	arrayCouplets.sort( sort_couplets );

	var arrayOut = new Array();
	for( i in arrayCouplets) {
		arrayOut[ arrayCouplets[ i ][ 'key' ] ] = arrayCouplets[ i ][ 'value' ];
	}

	return arrayOut;
}

function sort_couplets( coupletA, coupletB ) {
	return coupletA[ 'value' ] > coupletB[ 'value' ];
}  

/* END SORT */

	/**
	 * Draw points
	 */

	astrology.Radix.prototype.drawPoints = function(){

		if(this.data.planets == null){
			return;
		}

		var universe = this.universe;		
		var wrapper = astrology.utils.getEmptyWrapper( universe, astrology.ID_CHART + "-" + astrology.ID_RADIX + "-" + astrology.ID_POINTS);					
		var gap = this.radius - (this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO + this.radius/astrology.INDOOR_CIRCLE_RADIUS_RATIO);								
		var step = ( gap - 2*astrology.PADDING ) / Object.keys(this.data.planets).length;					
		var pointerRadius = this.radius - (this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO + this.rulerRadius);
		var startPosition, endPosition;

		astrology.COLLISION_RADIUS = 10; /* 10 */

        console.log(this.data.planets);
		//var ranking = helper.arr.multisort(this.data.planets[0], [0], ['ASC']);
		//this.data.planets = getSortedKeys(this.data.planets);
		//var temp = array_sort(this.data.planets);
        //console.log(temp);
		
		for (var planet in this.data.planets) {
			
		//for (var pln in arr) {
			
			//planet =  arr[pln].name;
			//console.log(planet);

 		   if (this.data.planets.hasOwnProperty( planet )) { 		   	 		   	 		   		 		   		

 		   		var position = astrology.utils.getPointPosition( this.cx, this.cy, this.pointRadius, this.data.planets[planet][0] + this.shift);	
 		   		var point = {name:planet, x:position.x, y:position.y, r:astrology.COLLISION_RADIUS, angle:this.data.planets[planet][0] + this.shift, pointer:this.data.planets[planet][0] + this.shift}; 		   		
 		   		this.locatedPoints = astrology.utils.assemble(this.locatedPoints, point, {cx:this.cx, cy:this.cy, r:this.pointRadius});   

 		   	} 		

		}

		console.log( "Count of planets: " + this.locatedPoints.length );
	
        this.locatedPoints.sort((a, b) => (a.angle > b.angle) ? 1 : -1);
        console.log(this.locatedPoints);
		
		/*
		var arr = [,];
		arr.push(this.locatedPoints);
		arr.sort((a, b) => (a.angle > b.angle) ? 1 : -1);
        console.log(arr);
		
		for(i=0;i<15;i++){
			this.locatedPoints[i].x = arr[0][i].x;
			this.locatedPoints[i].y = arr[0][i].y;
			this.locatedPoints[i].r = arr[0][i].r;
			this.locatedPoints[i].cx = arr[0][i].cx;
			this.locatedPoints[i].cy = arr[0][i].cy;
			this.locatedPoints[i].r = arr[0][i].r;
			this.locatedPoints[i].angle = arr[0][i].angle;
			this.locatedPoints[i].name = arr[0][i].name;
			this.locatedPoints[i].pointer = arr[0][i].pointer;
			
		}
		*/
		
        //count = -1;
		this.locatedPoints.forEach(function(point){
		//arr.forEach(function(point){
		//for (var pln in arr) {

            //count += 1;
			//point.name =  arr[count].name;
			//console.log(planet);
						        


        	// draw pointer        	

        	startPosition = astrology.utils.getPointPosition( this.cx, this.cy, pointerRadius, this.data.planets[point.name][0] + this.shift);
        	endPosition = astrology.utils.getPointPosition(this.cx, this.cy, pointerRadius-this.rulerRadius/2, this.data.planets[point.name][0] + this.shift );
        	var pointer = this.paper.line( startPosition.x, startPosition.y, endPosition.x, endPosition.y);
        	pointer.setAttribute("stroke", astrology.CIRCLE_COLOR);		 
			pointer.setAttribute("stroke-width", 1);
        	wrapper.appendChild(pointer);

        	// draw pointer line

        	if( !astrology.STROKE_ONLY && (this.data.planets[point.name][0] + this.shift) != point.angle){	        	

	        	startPosition = endPosition;
	        	endPosition = astrology.utils.getPointPosition(this.cx, this.cy, this.pointRadius+astrology.COLLISION_RADIUS, point.angle );
	        	var line = this.paper.line( startPosition.x, startPosition.y, endPosition.x, endPosition.y);
	        	line.setAttribute("stroke", astrology.LINE_COLOR);	
	        	line.setAttribute("stroke-width", 0.5);        	
	        	wrapper.appendChild(line);

        	}        	

        	// draw symbol						
			var symbol = this.paper.getSymbol(point.name, point.x, point.y);
        	symbol.setAttribute('id', astrology.ID_CHART + "-" + astrology.ID_RADIX + "-" + astrology.ID_POINTS + "-" + point.name);        	
        	wrapper.appendChild( symbol );

        	// draw point descriptions
        	var textsToShow = [(Math.round(this.data.planets[point.name][0]) % 30).toString()];

        	if( Array.isArray( this.data.planets[point.name][2] )){
        		textsToShow = textsToShow.concat( this.data.planets[point.name][2] );
        	}   

        	var pointDescriptions = astrology.utils.getDescriptionPosition(point, textsToShow);         	

        	pointDescriptions.forEach(function(dsc){        		        		        		     

				wrapper.appendChild( this.paper.text( dsc.text, dsc.x, dsc.y, astrology.POINTS_TEXT_SIZE, astrology.SIGNS_COLOR) );	        		

        	}, this);


		}, this);		

	};

	astrology.Radix.prototype.drawAxis = function(){

		if(this.data.cusps == null){
			return;
		}

		var universe = this.universe;
		var wrapper = astrology.utils.getEmptyWrapper( universe, astrology.ID_CHART + "-" + astrology.ID_RADIX + "-" + astrology.ID_AXIS);
		var axisRadius = this.radius + ((this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO)/4);

		var AS = 0;
		var IC = 3;
		var DC = 6;
		var MC = 9;
		var overlapLine,startPosition,endPosition,line,lines;

		[AS,IC,DC,MC].forEach( function(i) {

			// overlap 												
			//startPosition = astrology.utils.getPointPosition( this.cx, this.cy, this.radius, this.data.cusps[i] + this.shift);
			//endPosition = astrology.utils.getPointPosition( this.cx, this.cy, axisRadius, this.data.cusps[i] + this.shift);
			
			startPosition = astrology.utils.getPointPosition( this.cx, this.cy, this.radius, this.data.angles[i] + this.shift);
			endPosition = astrology.utils.getPointPosition( this.cx, this.cy, axisRadius, this.data.angles[i] + this.shift);
			overlapLine = this.paper.line( startPosition.x, startPosition.y, endPosition.x, endPosition.y); 				 			
			overlapLine.setAttribute("stroke", astrology.LINE_COLOR);		 				 				 		
			overlapLine.setAttribute("stroke-width", astrology.SYMBOL_AXIS_STROKE);
			wrapper.appendChild( overlapLine ); 

			// As

		 	if(i == AS){ 

		 		// Text
		 		//textPosition = astrology.utils.getPointPosition( this.cx, this.cy, axisRadius + (20 * astrology.SYMBOL_SCALE), this.data.cusps[i] + this.shift);
				textPosition = astrology.utils.getPointPosition( this.cx, this.cy, axisRadius + (20 * astrology.SYMBOL_SCALE), this.data.angles[i] + this.shift);
		 		wrapper.appendChild( this.paper.getSymbol( astrology.SYMBOL_AS, textPosition.x, textPosition.y));

		 	}

		 	// Ds

		 	if(i == DC){  		 		 		 		 		 		 		 

		 		// Text
		 		//textPosition = astrology.utils.getPointPosition( this.cx, this.cy, axisRadius + (2 * astrology.SYMBOL_SCALE), this.data.cusps[i] + this.shift);
				textPosition = astrology.utils.getPointPosition( this.cx, this.cy, axisRadius + (2 * astrology.SYMBOL_SCALE), this.data.angles[i] + this.shift);
		 		wrapper.appendChild( this.paper.getSymbol( astrology.SYMBOL_DS, textPosition.x, textPosition.y));

		 	}


		 	// Ic

		 	if(i == IC){ 

		 		// Text
		 		//textPosition = astrology.utils.getPointPosition( this.cx, this.cy, axisRadius + (10 * astrology.SYMBOL_SCALE), this.data.cusps[i] - 2 + this.shift);
				textPosition = astrology.utils.getPointPosition( this.cx, this.cy, axisRadius + (10 * astrology.SYMBOL_SCALE), this.data.angles[i] - 2 + this.shift);
		 		wrapper.appendChild( this.paper.getSymbol( astrology.SYMBOL_IC, textPosition.x, textPosition.y));

		 	}

		 	// Mc

		 	if(i == MC){ 		 		 		 	

		 		// Text
		 		//textPosition = astrology.utils.getPointPosition( this.cx, this.cy, axisRadius + (10 * astrology.SYMBOL_SCALE), this.data.cusps[i] + 2 + this.shift);
				textPosition = astrology.utils.getPointPosition( this.cx, this.cy, axisRadius + (10 * astrology.SYMBOL_SCALE), this.data.angles[i] + 2 + this.shift);
		 		wrapper.appendChild( this.paper.getSymbol( astrology.SYMBOL_MC, textPosition.x, textPosition.y));

		 	} 

	 	}, this);

	};

	/**
	 * Draw cusps
	 */

	astrology.Radix.prototype.drawCusps = function(){

		if(this.data.cusps == null){
			return;
		}

		var startPosition, endPosition, lines, line;
		var universe = this.universe;
		var wrapper = astrology.utils.getEmptyWrapper( universe, astrology.ID_CHART + "-" + astrology.ID_RADIX + "-" + astrology.ID_CUSPS);
		var numbersRadius = this.radius/astrology.INDOOR_CIRCLE_RADIUS_RATIO + astrology.COLLISION_RADIUS;

		var AS = 0;
		var IC = 3;
		var DC = 6;
		var MC = 9;
		var mainAxis = [AS,IC,DC,MC];

		//Cusps

		for (var i = 0, ln = this.data.cusps.length; i < ln; i++) {

 			// Draws a dashed line when an point is in the way
 			lines = astrology.utils.getDashedLinesPositions(

 				this.cx, 
 				this.cy, 
 				this.data.cusps[i] + this.shift, 
 				this.radius/astrology.INDOOR_CIRCLE_RADIUS_RATIO, 
 				this.radius - (this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO + this.rulerRadius),
 				this.pointRadius,
 				this.locatedPoints
 				);

 			lines.forEach(function(line){ 				

 				line = this.paper.line( line.startX, line.startY, line.endX, line.endY);
 				line.setAttribute("stroke", astrology.LINE_COLOR);	 				 			 				 			

 				if(mainAxis.indexOf(i) != -1){ 					

 					line.setAttribute("stroke-width", astrology.SYMBOL_AXIS_STROKE);

 				}else{

 					line.setAttribute("stroke-width", astrology.CUSPS_STROKE);	 					

 				}	 			 			 	

 		 		wrapper.appendChild( line );  				

 			}, this);	


 		 	// Cup number  		 	
 		 	var deg360 = astrology.utils.radiansToDegree( 2 * Math.PI );
 		 	var startOfCusp = this.data.cusps[i];
 		 	var endOfCusp = this.data.cusps[ (i+1)%12 ];
 		 	var gap = endOfCusp - startOfCusp > 0 ? endOfCusp - startOfCusp : endOfCusp - startOfCusp + deg360;
 		 	var textPosition = astrology.utils.getPointPosition( this.cx, this.cy, numbersRadius, ((startOfCusp + gap/2) % deg360) + this.shift );
 		 	wrapper.appendChild( this.paper.getSymbol( (i+1).toString(), textPosition.x, textPosition.y )); 		 	  		 			  		 			

		}						      	      

	};

	/**
	 * Draw aspects
	 */

	astrology.Radix.prototype.aspects = function(){

		if(!this.data.planets){
			return context;	
		}

		var universe = this.universe;		
		var wrapper = astrology.utils.getEmptyWrapper( universe, astrology.ID_CHART + "-" + astrology.ID_ASPECTS);
		var points  = this.data.planets;
		var toPoints = this.toPoints;		


		var calculator = new astrology.AspectCalculator( toPoints );
		var aspectsList = calculator.radix( points );

		var duplicateCheck = [];

		for(var i = 0, ln = aspectsList.length; i < ln; i++){

			var key	= aspectsList[i].name + "-" + aspectsList[i].point + "-" + aspectsList[i].toPoint;
			var opositeKey	= aspectsList[i].name + "-" + aspectsList[i].toPoint + "-" + aspectsList[i].point;									

			if( duplicateCheck.indexOf( opositeKey ) == -1 ){			


				duplicateCheck.push( key );

				var startPoint = astrology.utils.getPointPosition(this.cx, this.cy, this.radius/astrology.INDOOR_CIRCLE_RADIUS_RATIO, toPoints[aspectsList[i].toPoint][0] +this.shift );
				var endPoint = astrology.utils.getPointPosition(this.cx, this.cy, this.radius/astrology.INDOOR_CIRCLE_RADIUS_RATIO, points[aspectsList[i].point][0]+this.shift);
				var line = this.paper.line( startPoint.x, startPoint.y, endPoint.x, endPoint.y);       		       		       
				line.setAttribute("stroke", astrology.STROKE_ONLY ? astrology.LINE_COLOR : astrology.ASPECTS[aspectsList[i].name].color);		 				 				 		
				line.setAttribute("stroke-width", 1);       		
				wrapper.appendChild( line );			

			}

		}         

        // this
        return context;
	};

	/**
	 * Add points of interest for aspects calculation
	 * @param {Obect} points, {"As":[0],"Ic":[90],"Ds":[180],"Mc":[270]} 
	 * @see (astrology.AspectCalculator( toPoints) )
	 */

	astrology.Radix.prototype.addPointsOfInterest = function( points ){

		for(point in points){
			this.toPoints[ point ] = points[point]; 	
		}

        return context;	

	};

	astrology.Radix.prototype.drawRuler = function drawRuler(){

		var universe = this.universe;		
		var wrapper = astrology.utils.getEmptyWrapper( universe, astrology.ID_CHART + "-" + astrology.ID_RADIX + "-" + astrology.ID_RULER);
		var startRadius = (this.radius - (this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO + this.rulerRadius));		
		var rays = astrology.utils.getRulerPositions( this.cx, this.cy, startRadius, startRadius + this.rulerRadius, this.shift);

		rays.forEach(function( ray ){

			var line = this.paper.line( ray.startX, ray.startY, ray.endX, ray.endY);       		       		       
			line.setAttribute("stroke", astrology.CIRCLE_COLOR);		 				 				 		
			line.setAttribute("stroke-width", 1);       		
			wrapper.appendChild( line );				
		}, this);

		var circle;			
		circle = this.paper.circle( this.cx, this.cy, startRadius);
		circle.setAttribute("stroke", astrology.CIRCLE_COLOR);		 
		circle.setAttribute("stroke-width", 1);
        wrapper.appendChild( circle );       	       	

	};

	/**
	 * Draw circles
	 */

	astrology.Radix.prototype.drawCircles = function drawCircles(){

		var universe = this.universe;		
		var wrapper = astrology.utils.getEmptyWrapper( universe, astrology.ID_CHART + "-" + astrology.ID_RADIX + "-" + astrology.ID_CIRCLES);
		var circle;

        //indoor circle
        circle = this.paper.circle( this.cx, this.cy, this.radius/astrology.INDOOR_CIRCLE_RADIUS_RATIO);
        circle.setAttribute("stroke", astrology.CIRCLE_COLOR);
		circle.setAttribute("stroke-width", astrology.CIRCLE_STRONG);
       	wrapper.appendChild( circle );
       	
       	//outdoor circle
		circle = this.paper.circle( this.cx, this.cy, this.radius);
		circle.setAttribute("stroke", astrology.CIRCLE_COLOR);	
		circle.setAttribute("stroke-width", astrology.CIRCLE_STRONG);
        wrapper.appendChild( circle );

       	//inner circle
       	circle = this.paper.circle( this.cx, this.cy, this.radius-this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO);
       	circle.setAttribute("stroke", astrology.CIRCLE_COLOR);
		circle.setAttribute("stroke-width", astrology.CIRCLE_STRONG);
        wrapper.appendChild( circle );
		
		//Center inner most circle Astroworld		
       	if(astrology.SHOW_INNER_CIRCLE){
		circle = this.paper.circle( this.cx, this.cy, this.radius/astrology.INDOOR_CIRCLE_RADIUS_RATIO/3.5);
       	circle.setAttribute("stroke", astrology.COLOR_INNER_CIRCLE);		 
		circle.setAttribute("stroke-width", astrology.CIRCLE_STRONG);
		circle.setAttribute("fillStyle", astrology.COLOR_INNER_BACKGROUND);
		circle.setAttribute("fill", astrology.COLOR_INNER_BACKGROUND);
        wrapper.appendChild( circle );
		}
		//Astroworld

	};

	/**
	 * Display transit horoscope
	 * 
	 * @param {Object} data
	 * @example
	 *	{
	 *		"planets":{"Moon":[0], "Sun":[30],  ... },
	 *		"cusps":[300, 340, 30, 60, 75, 90, 116, 172, 210, 236, 250, 274],	*		 
	 *	} 
	 * 
	 * @return {astrology.Transit} transit
	 */

	astrology.Radix.prototype.transit = function( data ){

		// remove axis (As, Ds, Mc, Ic) from radix
		astrology.utils.getEmptyWrapper( this.universe, astrology.ID_CHART + "-" + astrology.ID_RADIX + "-" + astrology.ID_AXIS);
		var transit = new astrology.Transit(context, data);
		transit.drawBg();					
		transit.drawPoints();		
		transit.drawCusps();	
		transit.drawRuler();			
		transit.drawCircles();	
		return transit; 			

	};

}( window.astrology = window.astrology || {}));

// ## Transit chart ###################################

(function( astrology ) {

	var context;

	/**
	 * Transit charts.
	 * 
	 * @class
	 * @public
	 * @constructor
 	 * @param {astrology.Radix} radix 
	 * @param {Object} data
	 */

	astrology.Transit = function( radix, data ){

		// Validate data
		var status = astrology.utils.validate(data);		 		

		if( status.hasError ) {										

			throw new Error( status.messages );

		}

		this.data = data;								
		this.paper = radix.paper; 
		this.cx = radix.cx;
		this.cy = radix.cy;
		this.toPoints = radix.toPoints;
		this.radius = radix.radius;

		// after calling this.drawPoints() it contains current position of point
		this.locatedPoints = [];
		this.rulerRadius = ((this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO)/astrology.RULER_RADIUS);
    	this.pointRadius = this.radius + (this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO +  astrology.PADDING);
		this.shift = radix.shift;		
		this.universe = document.createElementNS(this.paper.root.namespaceURI, "g");
		this.universe.setAttribute('id', astrology.ID_CHART + "-" + astrology.ID_TRANSIT);
		this.paper.root.appendChild( this.universe );

		context = this; 
		return this;

	};

	/**
	 * Draw background
	 */

	astrology.Transit.prototype.drawBg = function(){				

		var universe = this.universe;		
    	var wrapper = astrology.utils.getEmptyWrapper( universe, astrology.ID_CHART + "-" + astrology.ID_BG);	

		var LARGE_ARC_FLAG = 1;	
		var start = 0; //degree
		var end = 359.99; //degree 				

		var hemisphere = this.paper.segment( this.cx, this.cy, this.radius+this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO, start, end, this.radius/astrology.INDOOR_CIRCLE_RADIUS_RATIO, LARGE_ARC_FLAG);
		hemisphere.setAttribute("fill", astrology.STROKE_ONLY ? "none" : astrology.COLOR_BACKGROUND);				
		wrapper.appendChild( hemisphere );							

	};

	/**
	 * Draw points
	 */

	astrology.Transit.prototype.drawPoints = function(){

		if(this.data.planets == null){

			return;

		}

		var universe = this.universe;		
		var wrapper = astrology.utils.getEmptyWrapper( universe, astrology.ID_CHART + "-" + astrology.ID_TRANSIT + "-" + astrology.ID_POINTS);
		var gap = this.radius - (this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO + this.radius/astrology.INDOOR_CIRCLE_RADIUS_RATIO);								
		var step = ( gap - 2*astrology.PADDING ) / Object.keys(this.data.planets).length;
		var pointerRadius = this.radius + (this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO);
		var startPosition, endPosition;

		for (var planet in this.data.planets) {

 		   if (this.data.planets.hasOwnProperty( planet )) {

 		   		var position = astrology.utils.getPointPosition( this.cx, this.cy, this.pointRadius, this.data.planets[planet][0] + this.shift); 		   	
 		   		var point = {name:planet, x:position.x, y:position.y, r:astrology.COLLISION_RADIUS, angle:this.data.planets[planet][0] + this.shift, pointer:this.data.planets[planet][0] + this.shift}; 		   		
 		   		this.locatedPoints = astrology.utils.assemble(this.locatedPoints, point, {cx:this.cx, cy:this.cy, r:this.pointRadius});   

 		   	} 		

		}

		this.locatedPoints.forEach(function(point){

        	// draw pointer        	
        	startPosition = astrology.utils.getPointPosition( this.cx, this.cy, pointerRadius, this.data.planets[point.name][0] + this.shift);
        	endPosition = astrology.utils.getPointPosition(this.cx, this.cy, pointerRadius+this.rulerRadius/2, this.data.planets[point.name][0] + this.shift );
        	var pointer = this.paper.line( startPosition.x, startPosition.y, endPosition.x, endPosition.y);
        	pointer.setAttribute("stroke", astrology.CIRCLE_COLOR);		 
			pointer.setAttribute("stroke-width", 1);
        	wrapper.appendChild(pointer);

        	// draw pointer line

        	if( !astrology.STROKE_ONLY && (this.data.planets[point.name][0] + this.shift) != point.angle){	        	

	        	startPosition = endPosition;
	        	endPosition = astrology.utils.getPointPosition(this.cx, this.cy, this.pointRadius-astrology.COLLISION_RADIUS, point.angle );

	        	var line = this.paper.line( startPosition.x, startPosition.y, endPosition.x, endPosition.y);
	        	line.setAttribute("stroke", astrology.LINE_COLOR);	
	        	line.setAttribute("stroke-width", 0.5);        	
	        	wrapper.appendChild(line);

        	}        	


        	// draw symbol						

			var symbol = this.paper.getSymbol(point.name, point.x, point.y);
        	symbol.setAttribute('id', astrology.ID_CHART + "-" + astrology.ID_RADIX + "-" + astrology.ID_POINTS + "-" + point.name);        	
        	wrapper.appendChild( symbol );
        	        	        
        	// draw point descriptions
        	var textsToShow = [(Math.round(this.data.planets[point.name][0]) % 30).toString()];

        	if( Array.isArray( this.data.planets[point.name][2] )){

        		textsToShow = textsToShow.concat( this.data.planets[point.name][2] );

        	}   


        	var pointDescriptions = astrology.utils.getDescriptionPosition(point, textsToShow);         	

        	pointDescriptions.forEach(function(dsc){        		        		        		     

				wrapper.appendChild( this.paper.text( dsc.text, dsc.x, dsc.y, astrology.POINTS_TEXT_SIZE, astrology.SIGNS_COLOR) );	        		

        	}, this);


		}, this);


	};

	/**
	 * Draw circles
	 */

	astrology.Transit.prototype.drawCircles = function drawCircles(){

		var universe = this.universe;		
		var wrapper = astrology.utils.getEmptyWrapper( universe, astrology.ID_CHART + "-" + astrology.ID_TRANSIT + "-" + astrology.ID_CIRCLES);
		var radius = this.radius + this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO;
		var circle;			
		circle = this.paper.circle( this.cx, this.cy, radius);
		circle.setAttribute("stroke", astrology.CIRCLE_COLOR);		 
		circle.setAttribute("stroke-width", astrology.CIRCLE_STRONG);
        wrapper.appendChild( circle );										

	};

	/**
	 * Draw cusps
	 */

	astrology.Transit.prototype.drawCusps = function(){


		if(this.data.cusps == null){

			return;

		}

		var startPosition, endPosition, lines, line;
		var universe = this.universe;
		var wrapper = astrology.utils.getEmptyWrapper( universe, astrology.ID_CHART + "-" + astrology.ID_TRANSIT + "-" + astrology.ID_CUSPS);	
		var numbersRadius = this.radius + ((this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO - this.rulerRadius)/2);

		var AS = 0;
		var IC = 3;
		var DC = 6;
		var MC = 9;
		var mainAxis = [AS,IC,DC,MC];

		//Cusps

		for (var i = 0, ln = this.data.cusps.length; i < ln; i++) {

			// Lines 			 			 		 		
 			var startPosition = bottomPosition = astrology.utils.getPointPosition( this.cx, this.cy, this.radius, this.data.cusps[i] + this.shift);
 			var endPosition = astrology.utils.getPointPosition( this.cx, this.cy, this.radius + this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO - this.rulerRadius , this.data.cusps[i] + this.shift);
 			var line = this.paper.line( startPosition.x, startPosition.y, endPosition.x, endPosition.y);
 			line.setAttribute("stroke", astrology.LINE_COLOR);		 				 				 		
 			line.setAttribute("stroke-width", astrology.CUSPS_STROKE); 
 			wrapper.appendChild( line );

 			// Cup number  		 	
 		 	var deg360 = astrology.utils.radiansToDegree( 2 * Math.PI );
 		 	var startOfCusp = this.data.cusps[i];
 		 	var endOfCusp = this.data.cusps[ (i+1)%12 ];
 		 	var gap = endOfCusp - startOfCusp > 0 ? endOfCusp - startOfCusp : endOfCusp - startOfCusp + deg360;
 		 	var textPosition = astrology.utils.getPointPosition( this.cx, this.cy, numbersRadius, ((startOfCusp + gap/2) % deg360) + this.shift );
 		 	wrapper.appendChild( this.paper.getSymbol( (i+1).toString(), textPosition.x, textPosition.y )); 						
		}				

	};

	astrology.Transit.prototype.drawRuler = function drawRuler(){

		var universe = this.universe;		
		var wrapper = astrology.utils.getEmptyWrapper( universe, astrology.ID_CHART + "-" + astrology.ID_TRANSIT + "-" + astrology.ID_RULER);
		var startRadius = (this.radius + (this.radius/astrology.INNER_CIRCLE_RADIUS_RATIO));		
		var rays = astrology.utils.getRulerPositions( this.cx, this.cy, startRadius, startRadius - this.rulerRadius, this.shift);

		rays.forEach(function( ray ){

			var line = this.paper.line( ray.startX, ray.startY, ray.endX, ray.endY);       		       		       
			line.setAttribute("stroke", astrology.CIRCLE_COLOR);		 				 				 		
			line.setAttribute("stroke-width", 1);       		
			wrapper.appendChild( line );				

		}, this);

		var circle;			
		circle = this.paper.circle( this.cx, this.cy, startRadius - this.rulerRadius);
		circle.setAttribute("stroke", astrology.CIRCLE_COLOR);		 
		circle.setAttribute("stroke-width", 1);
        wrapper.appendChild( circle );       	       	

	};

	/**
	 * Draw aspects
	 */
	astrology.Transit.prototype.aspects = function(){

		if(!this.data.planets){

			return context;	

		}

		var universe = this.universe;		
		var wrapper = astrology.utils.getEmptyWrapper( universe, astrology.ID_CHART + "-" + astrology.ID_ASPECTS);

		var points  = this.data.planets;
		var toPoints = this.toPoints;		

		var calculator = new astrology.AspectCalculator( toPoints );
		var aspectsList = calculator.radix( points );

		for(var i = 0, ln = aspectsList.length; i < ln; i++){

				var startPoint = astrology.utils.getPointPosition(this.cx, this.cy, this.radius/astrology.INDOOR_CIRCLE_RADIUS_RATIO, toPoints[aspectsList[i].toPoint][0] +this.shift );
				var endPoint = astrology.utils.getPointPosition(this.cx, this.cy, this.radius/astrology.INDOOR_CIRCLE_RADIUS_RATIO, points[aspectsList[i].point][0]+this.shift);

				var line = this.paper.line( startPoint.x, startPoint.y, endPoint.x, endPoint.y);       		       		       
				line.setAttribute("stroke", astrology.STROKE_ONLY ? astrology.LINE_COLOR : astrology.ASPECTS[aspectsList[i].name].color);		 				 				 		
				line.setAttribute("stroke-width", 1);       		
				wrapper.appendChild( line );			

		}         

        // this
        return context;

	};

	/**
	 * Moves points to another position.
	 * 
 	 * @param {Object} data
	 */

	astrology.Transit.prototype.animate = function( data ){
		// TODO

	};

}( window.astrology = window.astrology || {}));

// ## Transit chart ###################################

(function( astrology ) {

	var context;

	/**
	 * Aspects calculator
	 * 
	 * @class
	 * @public
	 * @constructor 	 
	 * @param {Object} points; {"Sun":[0], "Moon":[90], "Neptune":[120], "As":[30]}
	 * @param {Object | null } settings
	 */

	astrology.AspectCalculator = function( toPoints, settings ){

		if(toPoints == null){

			throw new Error( "Param 'toPoint' must not be empty." );

		}

		this.settings = settings || {}; 		
		this.settings.aspects = settings && settings.aspects || astrology.ASPECTS;
		this.toPoints = toPoints;
		context = this; 
		return this;

	};

	/**
	 * Getter for this.toPoints
	 * @see constructor
	 * 
	 * @return {Object} 
	 */
	astrology.AspectCalculator.prototype.getToPoints = function(){

		return this.this.toPoints;

	};

	/**
	 * Radix aspects
	 * 
	 * In radix calculation is the param "points" the same as param "toPoints" in constructor 
	 * , but without special points such as: As,Ds, Mc, Ic, ...
	 * 
	 * @param {Object} points; {"Sun":[0], "Moon":[90]}
	 * 
	 * @return {Array<Object>} [{"aspect":"conjunction", "point":"Sun", "toPoint":"Moon", "precision":0.5}]]
	 */

	astrology.AspectCalculator.prototype.radix = function( points ){

		if(!points){

			return []; 

		}

		var aspects = [];			

		for (var point in points) {

 		   if (points.hasOwnProperty( point )) {

 		   	for (var toPoint in this.toPoints) {

 		   		if (this.toPoints.hasOwnProperty( toPoint )) { 		   			 		   			 		   		

 		   			if( point != toPoint){ 		   				 		   			 		   			 		   

	 		   			for(var aspect in this.settings.aspects){ 		   				

	 		   				if(hasAspect( points[point][0], this.toPoints[toPoint][0], this.settings.aspects[aspect])){
 					
	 		   				var t1 = point;
	 		   				var t2 = toPoint;

	 		   				if (t1 =="NNode" && t2 == "SNode") { break; }
	 		   				if (t2 =="NNode" && t1 == "SNode") { break; }
	 		   				if (t1 =="As" && t2 == "Mc") { break; }
	 		   				if (t2 =="As" && t1 == "Mc") { break; }

 		   					//alert(aspect + " " + calcPrecision(points[point][0], this.toPoints[toPoint][0], this.settings.aspects[aspect]["degree"])  + " "  + point  + " "  + toPoint  );	

	 		   					aspects.push(

	 		   								{

	 		   								"name":aspect, 
	 		   								"precision":calcPrecision(points[point][0], this.toPoints[toPoint][0], this.settings.aspects[aspect]["degree"]), 
	 		   								"point":point, 
	 		   								"toPoint":toPoint

	 		   								}

	 		   							)

	 		   				}

	 		   			}


 		   			} 		   		 		   						 


 		   		} 		   		


 		   	} 		   	 		   	 		  


 		   } 		

 		}

		return aspects;

	}; 

	/**
	 * Transit aspects
	 *
	 * @param {Object} points - transiting points; {"Sun":[0, 1], "Uranus":[90, -1], "NAME":[ANGLE, SPEED]}; 
	 * @return {Array<Object>} [{"aspect":"conjunction", "point":"Sun", "toPoint":"Moon", "precision":0.5}]]
	 */

	astrology.AspectCalculator.prototype.transit = function( points ){	

		if(!points){
			return []; 
		}

		var aspects = [];

		for (var point in points) {

 		   if (points.hasOwnProperty( point )) { 		   	

 		   		for (var toPoint in this.toPoints) {

 		   			if (this.toPoints.hasOwnProperty( toPoint )) {


 		   				for(var aspect in this.settings.aspects){ 		   				


	 		   				if(hasAspect( points[point][0], this.toPoints[toPoint][0], this.settings.aspects[aspect])){	 


	 		   					


	 		   					var precision = calcPrecision(points[point][0], this.toPoints[toPoint][0], this.settings.aspects[aspect]["degree"]);


	 		   					


	 		   					// -1 : is approaching to aspect


	 		   					// +1 : is moving away


	 		   					if(isTransitPointApproachingToAspect( this.settings.aspects[aspect]["degree"], this.toPoints[toPoint][0], points[point][0] )){


	 		   						precision *= -1;


	 		   					}


	 		   					


	 		   					// if transit has speed value && transit is retrograde


	 		   					if(points[point][1] && points[point][1] < 0 ){ 


	 		   						precision *= -1;


	 		   					}


	 		   						 		   						 		   						 		   							   				


	 		   					aspects.push(


	 		   								{


	 		   								"name":aspect, 


	 		   								"precision":precision, 


	 		   								"point":point, 


	 		   								"toPoint":toPoint


	 		   								}


	 		   							)


	 		   				}	 		   				


	 		   			} 		   		 		   		 		   	


 		   			}


 		   		} 		   	


 		   } 		


 		}


 		 		   						


		return aspects;


	};


	


	/*


	* @private


 	* @param {double} point


 	* @param {double} toPoint


 	* @param {Array} aspects; [DEGREE, ORBIT]


	 */


	function hasAspect(point, toPoint, aspect){


		var result = false;


		


		var gap = Math.abs( point - toPoint );


		


		if( gap > astrology.utils.radiansToDegree( Math.PI)){


			gap = astrology.utils.radiansToDegree( 2 * Math.PI) - gap;


		}


		


		var orbitMin = aspect["degree"] - (aspect["orbit"] / 2);


		var orbitMax = aspect["degree"] + (aspect["orbit"] / 2);


		


		if(orbitMin <= gap && gap <= orbitMax){											


			result = true;


		}


								


		return result;	


	}


	


	/*


	* @private 


 	* @param {Object} pointAngle


 	* @param {Object} toPointAngle


 	* @param {double} aspectDegree;


	 */


	function calcPrecision(point, toPoint, aspect){


		var gap = Math.abs( point - toPoint );		

		if( gap > astrology.utils.radiansToDegree( Math.PI)){
			gap = astrology.utils.radiansToDegree( 2 * Math.PI) - gap;
		}			

		return Math.abs( gap - aspect);

	}


	


	/*


	 * Calculate direction of aspect


	 * whether the transiting planet is approaching or is falling


	 * @private


	 * 


	 * //TODO


	 * This method is tested, and for tests gives the right results. 


	 * But the code is totally unclear. It needs to be rewritten.


	 * @param {double} aspect - aspect degree; for example 90.	


	 * @param {double} toPoint - angle of standing point


	 * @param {double} point - angle of transiting planet


	 * @return {boolean}


	 */


	function isTransitPointApproachingToAspect(aspect, toPoint, point){


		


		if( (point - toPoint) > 0 ){


			


			if((point - toPoint) > astrology.utils.radiansToDegree( Math.PI)){


				point = (point + aspect) % astrology.utils.radiansToDegree( 2 * Math.PI);


			}else{


				toPoint = (toPoint + aspect) % astrology.utils.radiansToDegree( 2 * Math.PI);


			}			


		}else{


			


			if((toPoint - point) > astrology.utils.radiansToDegree( Math.PI)){


				toPoint = (toPoint + aspect) % astrology.utils.radiansToDegree( 2 * Math.PI);


			}else{


				point = (point + aspect) % astrology.utils.radiansToDegree( 2 * Math.PI);


			}										


		}


		


		var _point = point;


		var _toPoint = toPoint;


		


		var difference = _point - _toPoint;


		


		if( Math.abs( difference ) > astrology.utils.radiansToDegree( Math.PI)){			


			_point = toPoint;


			_toPoint = point;


		}


							


		return (_point - _toPoint < 0);				


	}


		


}( window.astrology = window.astrology || {}));





// ## Zodiac ###################################


(function( astrology ) {


    


	/**


	 * Zodiac


	 * 


	 * Gives the position of points in the zodiac.


	 * Position of point in the zodiac.


	 * Position of point in houses.


	 * Dignities of planets.


	 * 


	 * @class


	 * @public


	 * @constructor 	


	 * @param {Array} cusps - cusprs in zodiac; [296, 350, 30, 56, 75, 94, 116, 170, 210, 236, 255, 274]


	 * @param {Object | null } settings


	 */


	astrology.Zodiac = function( cusps, settings){


		


		if(cusps == null){


			throw new Error( "Param 'cusps' must not be empty." );


		}


		


		if( !( Array.isArray(cusps) && cusps.length == 12) ){


			throw new Error( "Param 'cusps' is not 12 length Array." );


		}


		


		this.cusps = cusps;


		this.settings = settings || {}; 


						


		return this;


	};


	


	/**


	 * Get astrological sign


	 * 1 - Arise, ... , 12 - Pisces


	 * 


	 * @param {double} point - angle of point in circle


	 * @return { \[1-9] | 1[0-2]\ } 


	 */


	astrology.Zodiac.prototype.getSign = function( point ){


		var angle = point % astrology.utils.radiansToDegree( 2 * Math.PI);											


		return Math.floor((angle  / 30) + 1);			


	};


	


	/**


	 * Is retrograde


	 * 


 	 * @param {double} speed


 	 * @return {boolean}


	 */


	astrology.Zodiac.prototype.isRetrograde = function( speed ){


		return speed < 0;


	};


	 


	 /**


	 * Get house number


	 * 1 - 12


	 * 


	 * @param {double} point - angle of point in circle


	 * @return { \[1-9] | 1[0-2]\ }


	 */


	 astrology.Zodiac.prototype.getHouseNumber = function( point ){


	 	var angle = point % astrology.utils.radiansToDegree( 2 * Math.PI);	


	 	


	 	for(var i = 0, ln = this.cusps.length; i < ln; i++){


	 		if(angle >= this.cusps[i] && angle < this.cusps[ (i % (ln-1)) + 1 ]){


	 			return i + 1;


	 		}


	 	}


	 	


	 	// cusp passes over zero


	 	for(var i = 0, ln = this.cusps.length; i < ln; i++){


	 		if( this.cusps[i] > this.cusps[ (i % (ln-1)) + 1 ]){


	 			return i+1;


	 		}	


	 	}


	 		 	


		throw new Error( "Oops, serious error in the method: 'astrology.Zodiac.getHouseNumber'." );


	 };


	 


	 /**


	  * Calculate dignities of planet


	  *   


	  * r - Rulership 


	  * d - Detriment  


	  * e - Exaltation  


	  * E - Exalatation - Exact exaltation


	  * f - Fall 


	  *  


 	  * @param {Object} planet, { name:"Sun", angle:60.2 }


 	  * @return {Array<String>}


	  */


	 astrology.Zodiac.prototype.getDignities = function( planet ){


	 	// TODO


	 	return [];


	 };


	 					 


}( window.astrology = window.astrology || {}));





// ## UTILS #############################


(function( astrology ) {

	astrology.utils = {};

	/**
	 * Calculate position of the point on the circle.
	 * 
	 * @param {int} cx - center x 
	 * @param {int} cy - center y
	 * @param {int} radius
	 * @param {double} angle - degree			
	 * 
	 * @return {Object} - {x:10, y:20}
	 */	

	astrology.utils.getPointPosition = function( cx, cy, radius, angle ){
		var angleInRadius = (astrology.SHIFT_IN_DEGREES - angle) * Math.PI / 180;
		var xPos = cx + radius * Math.cos( angleInRadius );
		var yPos = cy + radius * Math.sin( angleInRadius );
		return {x:xPos, y:yPos};
	};

	astrology.utils.degreeToRadians = function( degree ){
		return degrees * Math.PI / 180;
	};

	astrology.utils.radiansToDegree = function( radians ){
		return radians * 180 / Math.PI;

	};

	/**
	 * Calculates positions of the point description
	 * 
	 * @param {Object} point
	 * @param {Array<String>} texts
	 * 
	 * @return {Array<Object>} [{text:"abc", x:123, y:456}, {text:"cvb", x:456, y:852}, ...]
	 */

	astrology.utils.getDescriptionPosition = function( point, texts ){
		var RATION = 1.4;
		var result = [];		
		var posX = point.x + (astrology.COLLISION_RADIUS/RATION * astrology.SYMBOL_SCALE)  ;
		var posY = point.y - (astrology.COLLISION_RADIUS * astrology.SYMBOL_SCALE);

		texts.forEach(function(text, idx){						
			result.push({text:text, x:posX, y:posY + (astrology.COLLISION_RADIUS/RATION * idx)});					
		}, this);

		return result;
	};

	/**
	 * Checks a source data
	 * @private
	 * 
	 * @param {Object} data
	 * @return {Object} status
	 */

	astrology.utils.validate = function( data ){

		var status = {hasError:false, messages:[]};
		if( data == null ){			
			status.messages.push( "Data is not set." );


			status.hasError = true;


			return status;


		}


		


		if(data.planets == null){					


			status.messages.push( "There is not property 'planets'." );


			status.hasError = true;


		}


		


		for (var property in data.planets) {


    		if (data.planets.hasOwnProperty(property)) {        		


        		if(!Array.isArray( data.planets[property] )){


        			status.messages.push( "The planets property '"+ property +"' has to be Array." );


					status.hasError = true;	


        		}


    		}


		}


					


		if(data.cusps != null && !Array.isArray(data.cusps)){


			status.messages.push( "Property 'cusps' has to be Array." );


			status.hasError = true;


		}


		


		if(data.cusps != null && data.cusps.length != 12){			


			status.messages.push( "Count of 'cusps' values has to be 12." );


			status.hasError = true;


		}


									


		return status;		


	};


	


	/**


	 * Get empty DOMElement with ID


	 * 


	 * @param{String} elementID


	 * @param{DOMElement} parent


	 * @return {DOMElement}


	 */


	astrology.utils.getEmptyWrapper = function( parent, elementID ){


		


		var wrapper = document.getElementById( elementID );		


		if(wrapper){


			astrology.utils.removeChilds( wrapper );


		}else{					


			wrapper = document.createElementNS( document.getElementById(astrology.ID_CHART).namespaceURI, "g");


			wrapper.setAttribute('id', elementID);


			parent.appendChild( wrapper );			


		} 


		


		return wrapper;


	};


	


	/**


	* Remove childs


	* 


	* @param{DOMElement} parent


	*/


	astrology.utils.removeChilds = function(parent){


		if( parent == null ){


			return;


		}


		


		var last;


    	while (last = parent.lastChild){


    		parent.removeChild(last);


    	}


	};


	


	/**


	 * Check circle collision between two objects 


	 * 


 	 * @param {Object} circle1, {x:123, y:123, r:50}


 	 * @param {Object} circle2, {x:456, y:456, r:60}


 	 * @return {boolean} 	 


	 */


	astrology.utils.isCollision = function(circle1, circle2){			


		//Calculate the vector between the circlesÃ¢â‚¬â„¢ center points


  		var vx = circle1.x - circle2.x;

  		var vy = circle1.y - circle2.y;

  		var magnitude = Math.sqrt(vx * vx + vy * vy);

  		var totalRadii = circle1.r + circle2.r;

		return magnitude <= totalRadii; 


	};


	/**
	 * Places a new point in the located list 
	 * 
 	 * @param {Array<Object>} locatedPoints, [{name:"Mars", x:123, y:123, r:50, ephemeris:45.96}, {name:"Sun", x:1234, y:1234, r:50, ephemeris:100.96}]
 	 * @param {Object} point, {name:"Venus", x:78, y:56, r:50, angle:15.96} 
 	 * @param {Object} universe - current universe
 	 * @return {Array<Object>} locatedPoints 	 
	 */


	astrology.utils.assemble = function( locatedPoints, point, universe){


		// first item

		if(locatedPoints.length == 0){


			locatedPoints.push(point);


			return locatedPoints; //================>


		}


		


		var isCollision = false;
		var doSwitch = true;


		locatedPoints.sort(astrology.utils.comparePoint);


		//locatedPoints.sort();


		for(var i = 0, ln = locatedPoints.length; i < ln; i++ ){			


			if(astrology.utils.isCollision(locatedPoints[i], point)){


				isCollision = true;
				
				/* Avoid switch on some collisions  + " " + ang_1 + " " + ang_2 */
                var Point_1 = point;
                var Point_2 = locatedPoints[i];
                var ang_1 = Point_1.angle;
                var ang_2 = Point_2.angle;
                if(ang_1 < 0){ang_1 += 360.0;}
                if(ang_2 < 0){ang_2 += 360.0;}
                if(ang_2 > ang_1){doSwitch = false;}
		        if((ang_2 < ang_1) && (Math.abs(ang_1-ang_2) > 180)){doSwitch = false;}
		        /* Avoid switch on some collisions */
				doSwitch = true;

				var locatedButInCollisionPoint =  locatedPoints[i];


				locatedButInCollisionPoint.index = i;


				console.log( "Resolve collision: " + locatedButInCollisionPoint.name + " X " + point.name);								


				break;


			}


		}	
		
		        

		if( isCollision && doSwitch){

			astrology.utils.placePointsInCollision(locatedButInCollisionPoint, point);

			var newPointPosition = astrology.utils.getPointPosition(universe.cx, universe.cy, universe.r, locatedButInCollisionPoint.angle);

			locatedButInCollisionPoint.x = newPointPosition.x;

			locatedButInCollisionPoint.y = newPointPosition.y;
			
			newPointPosition = astrology.utils.getPointPosition(universe.cx, universe.cy, universe.r, point.angle);

			point.x = newPointPosition.x;

			point.y = newPointPosition.y;


									  					


			// remove locatedButInCollisionPoint from locatedPoints									


			locatedPoints.splice(locatedButInCollisionPoint.index, 1);


																


			// call recursive	


			locatedPoints = astrology.utils.assemble(locatedPoints, locatedButInCollisionPoint, universe);	


			locatedPoints = astrology.utils.assemble(locatedPoints, point, universe);	


														


		} else {


			locatedPoints.push(point);	


		}


		


												


		return locatedPoints;	


	};


	


	/**
	 * Sets the positions of two points that are in collision.
	 * 
	 * @param {Object} p1, {..., pointer:123, angle:456}
	 * @param {Object} p2, {..., pointer:23, angle:56}
	 */

	astrology.utils.placePointsInCollision = function(p1, p2){

		var step = 1;

		if(

			// solving problems with zero crossing - AQUI										


			(p1.pointer <= p2.pointer && Math.abs(p1.pointer - p2.pointer) <= astrology.COLLISION_RADIUS) || (p1.pointer >= p2.pointer && Math.abs(p1.pointer - p2.pointer) >=  astrology.COLLISION_RADIUS)	&& (p1.angle < p2.angle)


		){

			p1.angle -= step;
			p2.angle += step;																


		} else {

			p1.angle += step;
			p2.angle -= step;						


		}			


	};


		


/**
	 * Check collision between angle and object 
	 * 
 	 * @param {double} angle
 	 * @param {Array<Object>} points, [{x:456, y:456, r:60, angle:123}, ...]
 	 * @return {boolean} 	 
	 */
	astrology.utils.isInCollision = function(angle, points){		
		var deg360 = astrology.utils.radiansToDegree(2*Math.PI);
		var collisionRadius = (astrology.COLLISION_RADIUS * astrology.SYMBOL_SCALE) / 2;
							
		var result = false;					
		for(var i = 0, ln = points.length; i < ln ; i++ ){
										
			if( Math.abs(points[i].angle - angle) <= collisionRadius || 
			Math.abs(deg360 - Math.abs(points[i].angle - angle)) <= collisionRadius){
				result = true;
				break;
			}					
		}				
					
		return result;			
	};
		
	/**
	 * Calculates positions of the dashed line passing through the obstacle.
	 * 	* 
	 * @param {double} centerX
	 * @param {double} centerY
	 * @param {double} angle - line angle
 	 * @param {double} lineStartRadius
 	 * @param {double} lineEndRadius
 	 * @param {double} obstacleRadius 	
 	 * @param {Array<Object>} obstacles, [{x:456, y:456, r:60, angle:123}, ...]
 	 * 
 	 * @return {Array<Object>} [{startX:1, startY:1, endX:4, endY:4}, {startX:6, startY:6, endX:8, endY:8}]
	 */
	astrology.utils.getDashedLinesPositions = function( centerX, centerY, angle, lineStartRadius, lineEndRadius, obstacleRadius, obstacles){
		var startPos, endPos;
		var result = [];	
		
		if( astrology.utils.isInCollision( angle, obstacles)){
			
			startPos = astrology.utils.getPointPosition( centerX, centerY, lineStartRadius, angle);
			endPos = astrology.utils.getPointPosition( centerX, centerY, obstacleRadius - (astrology.COLLISION_RADIUS * astrology.SYMBOL_SCALE), angle);			
			result.push( {startX:startPos.x, startY:startPos.y, endX:endPos.x, endY:endPos.y} );
			
			// the second part of the line when is space
			if( (obstacleRadius + 2*(astrology.COLLISION_RADIUS * astrology.SYMBOL_SCALE)) < lineEndRadius){
				startPos = astrology.utils.getPointPosition( centerX, centerY, obstacleRadius + 2*(astrology.COLLISION_RADIUS * astrology.SYMBOL_SCALE),angle); 			
				endPos = astrology.utils.getPointPosition( centerX, centerY, lineEndRadius, angle);				
				result.push( {startX:startPos.x, startY:startPos.y, endX:endPos.x, endY:endPos.y} ); 														
			}					
								
		}else{
			startPos = astrology.utils.getPointPosition( centerX, centerY, lineStartRadius, angle);
			endPos = astrology.utils.getPointPosition( centerX, centerY, lineEndRadius, angle);
			result.push( {startX:startPos.x, startY:startPos.y, endX:endPos.x, endY:endPos.y} );	
		}	
						
		return result;		
	};
	
	/**
	 * Calculate ruler positions.
	 * 
	 * @param {Double} centerX
	 * @param {Double} centerY
	 * @param {Double} startRadius
	 * @param {Double} endRadius
	 * @param {Boolean} startAngle
	 * 
	 * @return {Array<Object>} [ {startX:1,startY:2, endX:3, endX:4 }, ...]
	 */
	astrology.utils.getRulerPositions = function( centerX, centerY, startRadius, endRadius, startAngle ){	
		var result = [];
		
		var rayRadius = endRadius;
		var halfRayRadius = (startRadius <= endRadius) ? rayRadius - (Math.abs(endRadius-startRadius)/2): rayRadius + (Math.abs(endRadius-startRadius)/2); 
		
		for( i = 0, start = 0, step = 5; i < 72; i++ ){ 
			    var angle = start + startAngle;
			    var startPos = astrology.utils.getPointPosition( centerX, centerY, startRadius, angle);
				var endPos = astrology.utils.getPointPosition( centerX, centerY, (i%2 == 0 ? rayRadius : halfRayRadius), angle);				
				result.push({startX:startPos.x,startY:startPos.y, endX:endPos.x, endY:endPos.y });				
				
				start += step;
		} 
												
		return result;		
	};
	
	/**
	* Compare two points
	* 
	* @param {Object} pointA, {name:"Venus", x:78, y:56, r:50, angle:15.96}
	* @param {Object} pointB, {name:"Mercury", x:78, y:56, r:50, angle:20.26}
	* @return 
	*/
	astrology.utils.comparePoints = function( pointA, pointB){		
		return pointA.angle - pointB.angle; 			
	};
									
}( window.astrology = window.astrology || {}));