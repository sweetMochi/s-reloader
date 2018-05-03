<!-- UI mode -->
<a class="scroll" id="scrollme">回頂端</a>
<script>

	// andjosh/animatedScrollTo.js
	// gist.github.com/andjosh/6764939
	scrollme = document.querySelector("#scrollme")
	scrolltitle = document.querySelector("#title")
	scroll_path = 0

	scrollPath()

	scrollme.onclick = function() {
		scrollTo(document.documentElement, scroll_path, 300)
	}

	function scrollPath() {
		//stackoverflow.com/questions/3714628/jquery-get-the-location-of-an-element-relative-to-window
		var elem = document.querySelector("#title")
		var box = elem.getBoundingClientRect()
		var body = document.body
		var docEl = document.documentElement
		var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop
		var clientTop = docEl.clientTop || body.clientTop || 0
		var top = box.top + scrollTop - clientTop
		scroll_path = top
	}

	function scrollTo(element, to, duration) {
		var start = element.scrollTop,
			change = to - start,
			currentTime = 0,
			increment = 20;

		var animateScroll = function(){
			currentTime += increment;
			var val = Math.easeInOutQuad(currentTime, start, change, duration);
			element.scrollTop = val;
			if ( currentTime < duration ) {
				setTimeout(animateScroll, increment);
			}
		}
		animateScroll();
	}

	//t = current time
	//b = start value
	//c = change in value
	//d = duration
	Math.easeInOutQuad = function (t, b, c, d) {
		t /= d/2;
		if (t < 1) return c/2*t*t + b;
		t--;
		return -c/2 * (t*(t-2) - 1) + b;
	}

	window.onresize = function() {
		scrollPath()
	}

	window.onscroll = function() {
		if ( document.documentElement.scrollTop > scroll_path ) {
			scrollme.className = "scroll scroll-show";
		} else {
			scrollme.className = "scroll";
		}
	}
</script>
<div class="popout-bg" id="popout-bg" onclick="popoutClose()"></div>
<div class="popout-wrap" id="popout-wrap"><div class="popout-body"><span class="popout-text" id="popout-text"></span><div class="popout-btn popout-cancel" id="popout-cancel" onclick="popoutClose()">Cancel</div><div class="popout-btn popout-ok" id="popout-ok" onclick="popoutClose()">OK</div></div></div>
<script>

	var js_id = [
		"popout_ok",
		"popout_bg",
		"popout_text",
		"popout_wrap",
		"popout_cancel"
	]
	for (var i = js_id.length - 1; i >= 0; i--) {
		window[js_id[i]] = document.getElementById(js_id[i].replace("_", "-"))
	}

	var popout_ok_text_default = popout_ok.innerHTML
	var popout_ok_style_default = popout_ok.className

	// 從 index.js 定按鈕行為
	function popout (option) {

		popout_bg.style.visibility = "visible"
		popout_wrap.style.visibility = "visible"
		popout_wrap.className = "popout-wrap"
		popout_cancel.style.display = "none"
		popout_ok.innerHTML = popout_ok_text_default
		popout_ok.className = popout_ok_style_default
		popout_ok.onclick = function() { popoutClose() }

		if ( typeof option == "string" ) {
			popout_text.innerHTML = option
		} else {

			if ( "id" in option ) {
				var popout_id_html = document.querySelector("[data-popout-id=" + option.id + "]").innerHTML
				popout_text.innerHTML = popout_id_html
			} else
			if ( "html" in option || "text" in option ) {
				popout_text.innerHTML = option.html || option.text
			}
			if ( "cancel" in option && option.cancel == true ) {
				popout_cancel.style.display = "block"
			}
			if ( "ok_text" in option ) {
				popout_ok.innerHTML = option.ok_text
				popout_ok.className = "popout-btn popout-ok popout-ok-light"
			}
			if ( typeof option.callback === "function" ) {
				popout_ok.onclick = function() {
					option.callback()
					popoutClose()
				}
			}
			if ( "use_bg" in option && option.use_bg == true ) {
				popout_wrap.className += " popout-use-bg"
			}
			if ( "use_xl" in option && option.use_xl == true ) {
				popout_wrap.className += " popout-use-xl"
			}
		}
	}

	function popoutClose () {
		popout_bg.style.visibility = "hidden"
		popout_wrap.style.visibility = "hidden"
	}

</script>
<b class="coming-box-bg" data-coming-close></b>
<div class="coming-box coming-box-body"><span>敬請期待</span><b class="coming-box-close" data-coming-close>×</b></div>
<script>

	function comingBox () { document.body.classList.add("coming-box-show") }
	function comingBoxClose () { document.body.classList.remove("coming-box-show") }

	document.body.addEventListener("keyup", function(event){
		var e = event
		if (e.keyCode == 27 /* ESC */) {
			comingBoxClose ()
		}
	})

	coming_close = document.querySelectorAll("[data-coming-close]")

	for (var i = 0, len = Object.keys(coming_close).length; i < len; i++) {
		coming_close[i].addEventListener("click", comingBoxClose)
	}

	open_box_btn = document.querySelectorAll("[data-open]")

	if ( open_box_btn ) {

		for (var i = 0, len = Object.keys(open_box_btn).length; i < len; i++) {
			open_box_btn[i].addEventListener("click", function(event){
				event.preventDefault()
				var value = this.getAttribute("data-open").split("x")
				var href = this.getAttribute("href")
				var width = value[0]
				var height = value[1]
				window.open(href, '', 'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=' + width + ',height=' + height)
			})
		}
	}
</script>
<!-- End UI mode -->
