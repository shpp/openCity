<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Місто для всiх</title>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href="http://allfont.net/allfont.css?fonts=ukrainian-play" rel="stylesheet" type="text/css" />
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
		<link rel="stylesheet" href="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css">
	  <link rel="stylesheet" href="css/welcome.css">
	</head>
	<body>
		<aside>
			<ul id="nav-mobile" class="side-nav fixed">
        <li class="logo">
        	<a
        		href="http://opencity.shpp.me/"
        		class="brand-logo green-text">
            Мicто для вcix
          </a>
        </li>
        <li class="no-padding">
          <ul class="collapsible collapsible-accordion">
            <li class="bold active">
            	<a class="collapsible-header waves-effect waves-green active">
            		Категорії мiсць
            	</a>
              <div class="collapsible-body">
								<form id="categories-form">
									<ul id="categories" style="max-height: 50vh; overflow: auto; position: relative;">
										@foreach ($categories as $category)
										<li>
											<input
											type="checkbox"
											name="cat[]"
											id="cat{{$category->id}}"
											value="{{$category->id}}"
											class="filled-in"
											checked/>
											<label for="cat{{$category->id}}" class="black-text">
												{{$category->name}}
											</label>
										</li>
										@endforeach
									</ul>
								</form>
              </div>
            </li>
            <li class="bold">
            	<a class="collapsible-header waves-effect waves-green">
            		Параметри зручності
            	</a>
              <div class="collapsible-body">
								<form id="access-form">
	                <ul id="accessibility">
										@foreach ($accessibilities as $accessibility)
	                		<li>
												<input
													type="checkbox"
													name="acc[]"
													id="acc{{$accessibility->id}}"
													value="{{$accessibility->id}}"
													class="filled-in" />
												<label for="acc{{$accessibility->id}}" class="black-text">
													{{$accessibility->name}}
												</label>
											</li>
										@endforeach
									</ul>
								</form>
              </div>
            </li>
          </ul>
        </li>
      </ul>
		</aside>
		<main>
			<div class="content">
				<div class="search-wrapper card">
					<input
						id="search-input"
						placeholder="Почніть набирати назву закладу..."
						class="typeahead">
					<i class="material-icons">search</i>
				</div>
	 			<div id="map"></div>
				<div id="right-bar">
					<div id="right-bar-header">
						<span id="right-bar-close">
							<i class="material-icons">close</i>
						</span>
						<h3 id="right-bar-heading"></h3>
					</div>
					<div id="right-bar-address"></div>
					<div id="right-bar-access"></div>
				</div>
			</div>
		</main>
    <footer class="page-footer green">
			<div class="custom-footer-container">
				<div class="footer-description">
					<h5 class="white-text">Соціальний проект «Місто для всіх»</h5>
					<p class="white-text text-lighten-4">
						Це карта доступності міста Кропивницький для людей з особливими потребами та батьків з маленькими дітьми, за допомогою якої можна визначити об’єкт на карті та дізнатися його координати, контакти та атрибути доступності (наявність пандуса та кнопки виклику).
						Ми працюємо над тим, щоб наповнити базу проекту і завди раді допомозі. Тож якщо ви бажаєте долучитися та зробити наше місто зручнішим для всіх &mdash; зв'яжіться з нами:
					</p>
					<ul class="footer-contacts white-text">
						<li>
							<i class="material-icons">phone</i>
							<a href="tel:+380952409572">+380952409572</a>
						</li>
					</ul>
				</div>
				<div class="footer-form">
					<h5 class="white-text footer-form-heading">Напишіть нам!</h5>
					<form id="message-form" >
						{{ csrf_field() }}
						<!-- TODO -->
						<div class="row">
							<div class="input-field col s12">
								<input id="email" type="email" class="validate" name="email">
								<label for="email">Email</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<textarea name="text" id="message" class="materialize-textarea"></textarea>
								<label for="message">Ваш комментар</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<button
									class="btn white green-text waves-effect waves-light"
									type="submit"
									name="action">
									Вiдправити
									<i class="material-icons right">send</i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
      <div class="footer-copyright">
        <div class="container">
        	© 2017 made with love by
					<a
						href="http://programming.kr.ua"
						class="white-text"
						target="_blank">
						Ш++
					</a>
        </div>
      </div>
    </footer>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="/js/typeahead.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
		<script src="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key={{$google_api_key}}&amp;callback=initMap&amp;language=uk_UA&amp;region=ES" async defer></script>
		<script src="/js/mapinit.js"></script>
	</body>
</html>
