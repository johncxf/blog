//隐藏头部
var header = $('header');
var scrollDelta = 10;
var scrollOffset = 200;
var isScroll = false;
var previousTop = 0;
var currentTop = 0;

$(window).scroll(function() {
	if (!isScroll) {
		isScroll = true;
		(window.requestAnimationFrame)
			? requestAnimationFrame(autoHideHeader)
			: setTimeout(autoHideHeader, 250);
	}
});

function autoHideHeader() {
	currentTop = $(window).scrollTop();

	var distance = header.offset().top - header.height();
	if (previousTop >= currentTop) {
		if (previousTop - currentTop >= scrollDelta) {
			header.removeClass('is-hide');
		}
	}
	else {
		if (currentTop - previousTop >= scrollDelta && currentTop > scrollOffset) {
			header.addClass('is-hide');
		}
	}
	previousTop = currentTop;
	isScroll = false;
}

//导航
$('.scroll-h').click(function() {
	$('html,body').animate({
		scrollTop: '0px'
	},
	800);
});
$('.scroll-c').click(function() {
	$('html,body').animate({
		scrollTop: $('#comments').offset().top
	},
	800);
});
$('.scroll-b').click(function() {
	$('html,body').animate({
		scrollTop: $('#footer').offset().top
	},
	800);
});

//保护（开启会导致手机端不能长按识别二维码）
//$('[data-fancybox]').fancybox({
//	protect: true
//});

//移动端
var OS = function() {
  var a = navigator.userAgent,
      b = /(?:Android)/.test(a),
      d = /(?:Firefox)/.test(a),
      e = /(?:Mobile)/.test(a),
      f = b && e,
      g = b && !f,
      c = /(?:iPad.*OS)/.test(a),
      h = !c && /(?:iPhone\sOS)/.test(a),
      k = c || g || /(?:PlayBook)/.test(a) || d && /(?:Tablet)/.test(a),
      a = !k && (b || h || /(?:(webOS|hpwOS)[\s\/]|BlackBerry.*Version\/|BB10.*Version\/|CriOS\/)/.test(a) || d && e);
  return {
      android: b,
      androidPad: g,
      androidPhone: f,
      ipad: c,
      iphone: h,
      tablet: k,
      phone: a
     }
 }();


//图库

$("#article-content img").each(function() {
    var b = $(this),
        c = (b.attr("title"), b.parent("a")),
        d = typeof b.attr("noGallery");
   
//if (!OS.androidPhone && !OS.iphone) 
//  if(typeof lazyload == "function"){
    var $imgsrc = this.getAttribute("data-original");
//   } else{
//    var $imgsrc = this.getAttribute("src");
//  }
    void 0 !== b.attr("max") && b.wrap('<div class="max-img"></div>'),
            "undefined" === d && (c.length < 1 && (c = b.wrap('<a data-fancybox="gallery" no-pjax data-type="image" href="' + $imgsrc + '"></a>').parent("a")), c.addClass("light-link"),b.addClass("lazy"))
});


//提醒
$("#search-box").bind("input porpertychange",function() { 
  - 1 != $("#search-box").val().indexOf("自杀") && 
 ArmMessage.error('如需帮助请<a href="/about.html"><i class="fa fa-heart"></i> 联系我们</a><i class="fa fa-heart"></i>。') &&
 $('#search-box').val("");
});

//表情
function grin(tag) {
    	var myField;
    	tag = ' ' + tag + ' ';
        if (document.getElementById('comment-text') && document.getElementById('comment-text').type == 'textarea') {
    		myField = document.getElementById('comment-text');
    	} else {
    		return false;
    	}
    	if (document.selection) {
    		myField.focus();
    		sel = document.selection.createRange();
    		sel.text = tag;
    		myField.focus();
    	}
    	else if (myField.selectionStart || myField.selectionStart == '0') {
    		var startPos = myField.selectionStart;
    		var endPos = myField.selectionEnd;
    		var cursorPos = endPos;
    		myField.value = myField.value.substring(0, startPos)
    					  + tag
    					  + myField.value.substring(endPos, myField.value.length);
    		cursorPos += tag.length;
    		myField.focus();
    		myField.selectionStart = cursorPos;
    		myField.selectionEnd = cursorPos;
    	}
    	else {
    		myField.value += tag;
    		myField.focus();
    	}
        $("#smiles-sidebar").hide();
 }

//显示/隐藏表情包
$("#smilies").click(function(){
 if($("#smiles-sidebar").css("display")=="none"){
   $("#smiles-sidebar").show();
 } else {
   $("#smiles-sidebar").hide();
 }
});

$(document).bind('click', function (e) {
 if($(e.target).closest("#form-emoji").length == 0 && $(e.target).closest("#smiles-sidebar").length == 0 && $("#smiles-sidebar").css("display")!="none"){
   $("#smiles-sidebar").hide();
}});

//目录缩短
function getScrollHeight() {
  return document.body.scrollHeight || document.documentElement.scrollHeight;
}
function getClientHeight() {
  return Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
}
function getScrollTop() {
  return document.body.scrollTop || document.documentElement.scrollTop;
}

//短代码
$('.toggle-title').on('click', function () {
    $(this).parent().toggleClass('active')
});
$('.tabs-title').on('click', 'li', function (e) {
    e.preventDefault()
    const index = $(this).index()
    $(this).parent().find('li').removeClass('active')
    $(this).addClass('active')
    $('.tabs-content').removeClass('active')
    $('#mc-tab-' + index).addClass('active')
});
// 音频播放
var mcAudio = $('.mc-audio__source')[0]
var mcAudioBar = $('.mc-audio__bar')
var mcAudioBtn = $('.mc-audio__ctl-btn')
var mcAudioTime = $('.mc-audio__ctl-time')
$(mcAudio).on('canplay timeupdate', () => {
    const time = sec2minute(mcAudio.duration - mcAudio.currentTime)
    const outer = 100 - mcAudio.currentTime / mcAudio.duration * 100
    $(mcAudioTime).text(time)
    $(mcAudioBar).css('transform', `translateX(-${outer}%)`)
  })
$(mcAudio).on('play', () => {
    $(mcAudioBtn).addClass('play')
  })
$(mcAudio).on('ended error abort', () => {
    $(mcAudioBtn).removeClass('play')
  })
$(mcAudioBtn).on('click', () => {
    $(mcAudioBtn).toggleClass('play')
    if (mcAudio.paused) {
      mcAudio.play()
    } else {
      mcAudio.pause()
    }
});

//转换秒为分钟
var sec2minute = sec => {
   return [
      parseInt(sec / 60 % 60),
      parseInt(sec % 60)
    ].join(':').replace(/\b(\d)\b/g, '0$1')
}

//居中
$("#mc-video").each(function() {
	var b = $(this).parent("p");
	    b.addClass("tc");
});
$(".mc-button").each(function() {
	var b = $(this).parent("p");
	    b.addClass("tc");
});

// 文章语音朗读
  var speechList = []
  var speechIndex = 0
  var speechIsGet = false
  $('#post-text2speech').on('click', function () {
    if (speechIsGet) return
    var $self = $(this)
    var $text = $('#post-text2speech-text')
    var $time = $('#post-text2speech-time')
    var $progress = $('#post-text2speech-progress')
    let currentTime = 0
    let duration = 0

    if (speechList.length) {
      const speech = speechList[speechIndex]
      if (!speech.paused) {
        speech.pause()
      } else {
        speech.play()
      }
      return
    }

    speechIsGet = true
    $text.text('正在召唤小助手 ...')

    $.get('', { do: 'getSpeech' }, r => {
      speechIsGet = false
      if (!r || !r.data || !Array.isArray(r.data)) {
        $text.text('啊哦，召唤失败，点击重试~')
        return
      }
      r.data.forEach(v => {
        const speech = new window.Audio(v)
        speech.preload = 'metadata'
        speechList.push(speech)

        $(speech).on('play', () => {
          $text.text('正在朗读 ...')
          $self.addClass('isPlaying')
        })
        $(speech).on('pause', () => {
          $text.text('已暂停，点击继续')
          $self.removeClass('isPlaying')
        })
        $(speech).on('loadedmetadata', () => {
          duration = duration + speech.duration
          $time.text(`00:00 / ${sec2minute(duration)}`)
        })
        $(speech).on('timeupdate', () => {
          const nowTime = currentTime + speech.currentTime
          $progress.css('width', (nowTime / duration * 100).toFixed(2) + '%')
          $time.text(`${sec2minute(nowTime)} / ${sec2minute(duration)}`)
        })
        $(speech).on('ended', () => {
          currentTime += speech.duration
          if (speechIndex >= speechList.length - 1) {
            speechIndex = 0
            currentTime = 0
            $text.text('再次召唤小助手')
          } else {
            speechIndex += 1
            speechList[speechIndex].play()
          }
        })
        $(speech).on('error', () => {
          $text.text('语音资源加载失败')
        })
      })

      if (OS) {
        $text.text('小助手已上线，点击开始朗读')
      } else {
        speechList[0].play()
      }
    })
  });

//图片延迟加载
var imgLazyLoad = img => {
     $("img").lazyload({
      effect: 'fadeIn',
      placeholder_data_img:
        'data:image/gif;base64,R0lGODlhKwAeAJEAAP///93d3Xq9VAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFFAAAACwDAA0AJQADAAACEpSPAhDtHxacqcr5Lm416f1hBQAh+QQJFAAAACwDAA0AJQADAAACFIyPAcLtDKKcMtn1Mt3RJpw53FYAACH5BAkUAAAALAMADQAlAAMAAAIUjI8BkL0CoxQtrYrenPjcrgDbVAAAOw==',
      load:function(){
        $('.article-content img').addClass('lazy2');
      }
    });
};
$(window).on('load', () => {
    imgLazyLoad('.article-content img')
});

//评论
if($('#response').length <1){
  $('.comment-reply').css('display','none');
}

//一言
$.ajax({type:'Get',url:'//v1.hitokoto.cn/\?encode\=text',success:function(data) {$('.indexWords').text(data);}});

//二维码
$(".be-weixin").click(function(){
  imgLazyLoad('.wxloading img')
});

