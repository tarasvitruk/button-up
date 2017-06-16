<h1>Добавление кнопки “вверх”</h1>

Для начала добавьте в самый низ макета вашего сайта (лучше всего в footer) код кнопки:
``` html
<div id="scrollup"><img alt="Прокрутить вверх" src="/img/up.png"></div>
```
Загрузите кнопку, которая будет отображаться в блоке, я назвал ее up.png и загрузил в корневую папку /img/.

Найти крутые иконки и кнопки можно на www.iconfinder.com.

<h3>Теперь нужно открыть CSS-редактор и добавить стили для кнопки:</h3>

``` html
#scrollup {
position: fixed; /* фиксированная позиция */
opacity: 0.8; /* прозрачность */
padding: 15px 10px 10px; /* отступы */
background: #aaa;
border-radius: 5px; /* скругление углов */
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
left: 10px; /* отступ слева */
bottom: 10px; /* отступ снизу */
display: none; /* спрятать блок */
cursor: pointer;
}
```

Далее либо добавляем js-код в уже существующий файл с остальными скриптами, либо подключаем новый:
``` html
<script type='text/javascript' src='/js/scrollup.js'></script>
```
Дальше нужно написать саму функцию скролла.

<h1>Вариант №1: с использованием jQuery</h1>

<h3>Если у вас уже подключена jQuery, нужно сделать следующее: в scrollup.js добавляйте такой код:</h3>

``` html
jQuery( document ).ready(function() {
	jQuery('#scrollup img').mouseover( function(){
		jQuery( this ).animate({opacity: 0.65},100);
	}).mouseout( function(){
		jQuery( this ).animate({opacity: 1},100);
	}).click( function(){
		window.scroll(0 ,0); 
		return false;
	});

	jQuery(window).scroll(function(){
		if ( jQuery(document).scrollTop() > 0 ) {
			jQuery('#scrollup').fadeIn('fast');
		} else {
			jQuery('#scrollup').fadeOut('fast');
		}
	});
});
```

Если jQuery еще не подключен, тогда перед подключением scrollup.js нужно подключить ее:
``` html
<script type='text/javascript' src='http://code.jquery.com/jquery-latest.min.js'></script>
```

<h1>Вариант №2: на простом js</h1>

<h3>Если вы любите простоту, можно обойтись простым javascript:<h3>
``` html
window.onload = function() { // после загрузки страницы

	var scrollUp = document.getElementById('scrollup'); // найти элемент

	scrollUp.onmouseover = function() { // добавить прозрачность
		scrollUp.style.opacity=0.3;
		scrollUp.style.filter  = 'alpha(opacity=30)';
	};

	scrollUp.onmouseout = function() { //убрать прозрачность
		scrollUp.style.opacity = 0.5;
		scrollUp.style.filter  = 'alpha(opacity=50)';
	};

	scrollUp.onclick = function() { //обработка клика
		window.scrollTo(0,0);
	};

// show button

	window.onscroll = function () { // при скролле показывать и прятать блок
		if ( window.pageYOffset > 0 ) {
			scrollUp.style.display = 'block';
		} else {
			scrollUp.style.display = 'none';
		}
	};
};
```

Теперь у вас есть два способа добавить кнопку “прокрутить вверх” себе на сайт. 
Пример вы можете увидеть здесь: http://tokar.ua/demo/scrollup/
