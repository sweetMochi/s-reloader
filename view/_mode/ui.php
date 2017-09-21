
<a class="scroll" data-scroll>回頂端</a>
<script>

	scroll_option = {
		scroll : document.body,
		duration: 1000
	}

	function runScroll () {
		scroll_path = scroll_option.scroll.scrollTop
		scroll_time = scroll_option.duration
		scrollTo(scroll_option.scroll, 0, scroll_option.duration)
	}

	var scrollme
	var scroll_path = 0
	var scroll_time = 0

	scrollme = document.querySelector("[data-scroll]")
	scrollme.addEventListener("click", runScroll, false)

	function scrollTo(element, to, duration) {

		if ( duration <= 0 ) return
		var difference = to - element.scrollTop

		setTimeout(function() {
			element.scrollTop = scroll_path - easeInOutQuint(duration, scroll_path, difference, scroll_time)
			if (element.scrollTop == to) return
			scrollTo(element, to, duration - 10)
		}, 10);
	}

	function easeInOutQuint(t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	}

	window.onscroll = function() {
		if ( document.body.scrollTop > 600 ) {
			scrollme.className = "scroll scroll-show";
		} else {
			scrollme.className = "scroll";
		}
	}
</script>

<style>.popout-bg{display:none;position:fixed;z-index:10;top:0;right:0;bottom:0;left:0;background-color:rgba(255,255,255,.5)}.popout-wrap{display:none;position:fixed;z-index:10;top:40%;left:15%;width:70%;text-align:center;font-size:16px;overflow:hidden;border-radius:5px;background-color:#fff;line-height:1.7em}.popout-wrap .popout-body{padding:3% 2%; color:#666;}.popout-wrap .popout-ok{padding:10px 0;cursor:pointer;font-size:14px;color:#666;background-color:#eee}.popout-wrap .popout-ok:hover{background-color:#ccc}</style>
<div class="popout-bg" id="popout-bg"></div>
<div class="popout-wrap" id="popout-wrap">
	<div class="popout-body"><span id="popout-text"></span></div>
	<div class="popout-ok" onclick="closePopout()">確定</div>
</div>
<script>

	var popout_wrap = document.getElementById("popout-wrap")
	var popout_bg = document.getElementById("popout-bg")
	var popout_text = document.getElementById("popout-text")

	function popout (html) {
		popout_text.innerHTML		= html
		popout_bg.style.display		= "block"
		popout_wrap.style.display	= "block"
	}

	function closePopout () {
		popout_bg.style.display		= "none"
		popout_wrap.style.display	= "none"
	}

</script>

<b class="coming-box-bg" data-coming-close></b>
<div class="coming-box coming-box-body"><b class="coming-box-close" data-coming-close>×</b></div>
<script>

	function comingBox () { document.body.classList.add("coming-box-show") }
	function comingBoxClose () { document.body.classList.remove("coming-box-show") }

	document.body.addEventListener("keyup", function(event){
		var e = event
		if (e.keyCode == 27 /* ESC */) {
			comingBoxClose ()
		}
	})

	comingClose = document.querySelectorAll("[data-coming-close]")
	comingClose.forEach(function (item, idx) {
		item.addEventListener("click", comingBoxClose)
	})

</script>

<script>

	openBoxBtn = document.querySelectorAll("[data-open]")

	if ( openBoxBtn ) {
		openBoxBtn.forEach(function (item, idx) {
			item.addEventListener("click", function(event){
				event.preventDefault()
				var	value = this.getAttribute("data-open").split("x")
				var	href = this.getAttribute("href"),
					width = value[0],
					height = value[1]
				window.open(href, '', 'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=' + width + ',height=' + height)
			})
		})
	}
</script>
