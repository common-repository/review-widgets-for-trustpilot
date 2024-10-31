jQuery.fn.delayKeyup = function(callback, ms) {
	var timer = 0;
	var el = jQuery(this);
	var old = el.val();
	el.on('input', function(e) {
		if(old != el.val())
		{
			old = el.val();
			clearTimeout(timer);
			timer = setTimeout(callback, ms);
		}
	});
	return jQuery(this);
};

String.prototype.ucfirst = function() {
	return this.charAt(0).toUpperCase() + this.slice(1)
}

// Autocomplete config
var Trustindex_Autocomplete = null; 
jQuery(document).ready(function(){
	/*************************************************************************/
	/* NO REG MODE */

	Trustindex_Autocomplete = {
		box: jQuery("#trustindex-plugin-settings-page .autocomplete .results"),
		load: jQuery("#trustindex-plugin-settings-page .autocomplete .loading"),
		input: jQuery("#trustindex-plugin-settings-page .autocomplete input.name"),
		button: jQuery("#trustindex-plugin-settings-page .btn-search"),
		svg: {
			'Hotels': '<svg class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M810.666667 298.666667h-341.333334v298.666666H128V213.333333H42.666667v640h85.333333v-128h768v128h85.333333v-384a170.666667 170.666667 0 0 0-170.666666-170.666666M298.666667 554.666667a128 128 0 0 0 128-128 128 128 0 0 0-128-128 128 128 0 0 0-128 128 128 128 0 0 0 128 128z" fill="" /></svg>',
			'Restaurants': '<svg id="Layer_1" version="1.1" viewBox="0 0 30 30" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M23,19l-3.328-3.232C19.239,15.273,19,14.637,19,13.98V12c0-4.945,3.157-9.535,3.157-9.535L23,2.999V19z"/><circle cx="23" cy="3" r="1"/><path d="M24,3h-2l-1,10v13.5c0,0.828,0.672,1.5,1.5,1.5h0c0.828,0,1.5-0.672,1.5-1.5V3z"/><path d="M13.087,2.445C13.037,2.186,12.811,2,12.548,2C12.245,2,12,2.245,12,2.548v5.807C12,8.711,11.711,9,11.355,9  c-0.329,0-0.605-0.247-0.641-0.574l-0.66-5.939C10.023,2.21,9.789,2,9.509,2H9.5H9.491C9.211,2,8.977,2.21,8.946,2.488l-0.66,5.939  C8.25,8.753,7.974,9,7.645,9C7.289,9,7,8.711,7,8.355V2.548C7,2.245,6.755,2,6.452,2C6.189,2,5.963,2.186,5.913,2.445  C5.671,3.713,5,7.362,5,9c0,4,3,5,3,5v12.5C8,27.328,8.672,28,9.5,28s1.5-0.672,1.5-1.5V14c0,0,3-1,3-5  C14,7.362,13.329,3.713,13.087,2.445z"/></svg>',
			'Attractions': '<svg class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M533.333333 128.810667l43.008 0.149333c23.573333 0.085333 42.666667 19.413333 42.666667 42.816V213.333333H405.653333c0.298667-14.357333 0.106667-42.346667 0.106667-42.346666a42.197333 42.197333 0 0 1 42.56-42.496L490.666667 128.64V64a21.333333 21.333333 0 0 1 42.666666 0v64.810667zM726.677333 661.333333c85.482667 174.272 190.698667 277.333333 190.698667 277.333334H662.186667c-65.450667-148.181333-236.032-149.056-299.029334 0H105.088s105.173333-99.925333 191.146667-277.333334H234.666667a21.333333 21.333333 0 0 1 0-42.666666h554.666666a21.333333 21.333333 0 0 1 0 42.666666h-62.634666z m-103.872-362.666666c9.237333 102.464 34.346667 195.690667 66.304 277.333333H333.333333a1074.709333 1074.709333 0 0 0 66.986667-277.333333H362.666667a21.333333 21.333333 0 0 1 0-42.666667h298.666666a21.333333 21.333333 0 0 1 0 42.666667h-38.506666z" fill="#3D3D3D" /></svg>',
			'LodgingBusiness': '<svg class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M810.666667 298.666667h-341.333334v298.666666H128V213.333333H42.666667v640h85.333333v-128h768v128h85.333333v-384a170.666667 170.666667 0 0 0-170.666666-170.666666M298.666667 554.666667a128 128 0 0 0 128-128 128 128 0 0 0-128-128 128 128 0 0 0-128 128 128 128 0 0 0 128 128z" fill="" /></svg>',
		},
		searching: false,
		cache: [],
		search: function(platform) {
			let query_term = Trustindex_Autocomplete.input.val();

			if(query_term.length < 4)
			{
				Trustindex_Autocomplete.box.html('<span>'+ Trustindex_Autocomplete.box.data('tooshorttext') +'</span>');
				Trustindex_Autocomplete.box.show();
				return false;
			}

			if(Trustindex_Autocomplete.input.data('url') === undefined && (query_term.substr(0, 4) == 'www.' || query_term.substr(0, 7) == 'http://' || query_term.substr(0, 8) == 'https://'))
			{
				Trustindex_Autocomplete.box.html('<span>This is an URL. '+ Trustindex_Autocomplete.input.attr('placeholder') +'</span>');
				Trustindex_Autocomplete.box.show();
				return false;
			}
			else if(Trustindex_Autocomplete.input.data('url') === true && (query_term.substr(0, 4) == 'www.' || query_term.substr(0, 7) == 'http://' || query_term.substr(0, 8) == 'https://') && Trustindex_Autocomplete.checkRegex && !Trustindex_Autocomplete.checkRegex.test(query_term))
			{
				Trustindex_Autocomplete.box.html('<span>'+ Trustindex_Autocomplete.box.data('url-errortext') +'</span>');
				Trustindex_Autocomplete.box.show();
				return false;
			}

			//Return if request processing
			if(Trustindex_Autocomplete.searching)
			{
				return false;
			}

			//Hide box and show load
			Trustindex_Autocomplete.box.hide();
			Trustindex_Autocomplete.load.show();
			Trustindex_Autocomplete.searching = true;

			//Check cache
			let cache_term = query_term.trim();
			if(Trustindex_Autocomplete.cache[cache_term] !== undefined)
			{
				//Show results
				setTimeout(function() {
					Trustindex_Autocomplete.showResults(Trustindex_Autocomplete.cache[cache_term]);
				}, 400);

				return;
			}

			//Get request
			jQuery.ajax({
				method: "POST",
				url: "https://admin.trustindex.io/" + "api/searchPage",
				data: {
					q: query_term,
					platform: platform
				},
				dataType: "jsonp",
				success: function(response) {
					//Save cache
					Trustindex_Autocomplete.cache[cache_term] = response;

					//Show results
					Trustindex_Autocomplete.showResults(response);
				}
			});
		},
		showResults: function(response) {
			//Hide load
			Trustindex_Autocomplete.load.hide();
			Trustindex_Autocomplete.searching = false;

			//Check if we successfully receive results
			if(response.success && response.result && response.result.length)
			{
				let html = "";
				response.result.forEach(function(r) {
					html += '<li class="result" data-page-id="'+ r.page_id +'" data-name="'+ r.name +'" data-type="'+ r.type +'" data-url="' + r.url + '" data-address="' + r.address + '" data-avatar-url="'+ (r.avatar_url || '') +'">'
							+ (Trustindex_Autocomplete.svg[r.type] || '')
							+ '<p class="title">'+ r.name +'</p>'
							+ '<p class="location">'+ (r.address || r.url) +'</p>'
						+'</li>';
				});

				Trustindex_Autocomplete.box.html('<ul>' + html + '</ul>');
				Trustindex_Autocomplete.box.show();
			}
			//Request successful but do not receive results
			else if(response.success)
			{
				Trustindex_Autocomplete.box.html('<span>'+ Trustindex_Autocomplete.box.data('noresultstext') +'</span>');
				Trustindex_Autocomplete.box.show();
			}
			//Something went wrong
			else
			{
				Trustindex_Autocomplete.box.html('<span class="error">'+ Trustindex_Autocomplete.box.data('errortext') +'</span>');
				Trustindex_Autocomplete.box.show();
			}
		},
		showResult: function(response, error_text) {
			//Hide load
			Trustindex_Autocomplete.load.hide();
			Trustindex_Autocomplete.searching = false;

			if(typeof error_text == "undefined")
			{
				error_text = 'errortext';
			}

			//Check if we successfully receive results
			if(response.success && response.result)
			{
				let page_details = {
					id: response.result.page_id,
					name: response.result.name,
					address: response.result.address,
					avatar_url: response.result.avatar_url
				};

				let form = jQuery('#submit-form');
				let div = form.find(".ti-selected-source");
				form.find("#ti-noreg-page_details").val( JSON.stringify(page_details) );

				div.find("img").attr('src', page_details.avatar_url);
				div.find("#label-noreg-page_name").html( page_details.name );
				if(page_details.address)
				{
					div.find("#label-noreg-address").html( page_details.address + '<br />' );
				}
				div.find("#label-noreg-url").html( "<a target='_blank' href='" + response.result.url + "'>" + response.result.url + "</a>" );

				jQuery("#trustindex-plugin-settings-page .btn-check").addClass("btn-disabled");
				div.fadeIn();
			}
			//Something went wrong
			else
			{
				Trustindex_Autocomplete.box.html('<span class="error">'+ Trustindex_Autocomplete.box.data(error_text) +'</span>');
				Trustindex_Autocomplete.box.show();
			}
		},
		check: function(){
			let input = jQuery("#trustindex-plugin-settings-page #page-link");

			if(!Trustindex_Autocomplete.checkRegex)
			{
				return false;
			}

			let m = Trustindex_Autocomplete.checkRegex.exec(input.val());
			if(!Trustindex_Autocomplete.checkRegexValid(m))
			{
				Trustindex_Autocomplete.box.html('<span>'+ Trustindex_Autocomplete.box.data('errortext') +'</span>');
				Trustindex_Autocomplete.box.show();
				return false;
			}

			//Return if request processing
			if(Trustindex_Autocomplete.searching)
			{
				return false;
			}

			let page_id = m[1];
			if(m[2] !== undefined && m[2])
			{
				page_id += '|' + m[2];
			}

			//Hide box and show load
			Trustindex_Autocomplete.box.hide();
			Trustindex_Autocomplete.load.show();
			Trustindex_Autocomplete.searching = true;

			//Check cache
			let cache_term = page_id;
			if(Trustindex_Autocomplete.cache[cache_term] !== undefined)
			{
				//Show results
				setTimeout(function() {
					Trustindex_Autocomplete.showResult(Trustindex_Autocomplete.cache[cache_term]);
				}, 400);

				return;
			}

			//Get request
			jQuery.ajax({
				method: "POST",
				url: "https://admin.trustindex.io/" + "api/getPageDetails",
				data: {
					platform: jQuery('#submit-form').data('platform'),
					page_id: page_id
				},
				dataType: "jsonp",
				success: function(response) {
					//Save cache
					Trustindex_Autocomplete.cache[cache_term] = response;

					//Show results
					Trustindex_Autocomplete.showResult(response);
				}
			});
		},
		checkRegex: null,
		checkRegexValid: function(m) {
			if(!m)
			{
				return false;
			}

			for(let i = 0; i < m.length; i++) {
				if(m[i] === "")
				{
					return false;
				}
			}

			return true;
		}
	};

	//Automatically search on input
	if(Trustindex_Autocomplete.input.length)
	{
		Trustindex_Autocomplete.input.delayKeyup(function() {
			Trustindex_Autocomplete.button.click();
		}, 650);
	}

	//Search init after click
	if(Trustindex_Autocomplete.button.length)
	{
		Trustindex_Autocomplete.button.click(function(e) {
			e.preventDefault();

			Trustindex_Autocomplete.search(Trustindex_Autocomplete.button.closest('form').data('platform'));
		});
	}

	//Click on autocomplete's result
	jQuery(document).on('click', '#trustindex-plugin-settings-page .autocomplete .results li[data-page-id]', function() {
		let selected_element = jQuery(this);
		let form = selected_element.closest("form");
		let div = form.find(".ti-selected-source");

		let page_details = {
			id: selected_element.data('page-id'),
			name: selected_element.data('name'),
			address: selected_element.data('address'),
			avatar_url: selected_element.data('avatar-url')
		};

		form.find("#ti-noreg-page_details").val( JSON.stringify(page_details) );
		if(page_details.avatar_url)
		{
			div.find("img").attr('src', page_details.avatar_url).show();
		}
		else
		{
			div.find("img").hide();
		}
		div.find("#label-noreg-page_name").html( selected_element.data('name') );
		div.find("#label-noreg-url").html( "<a target='_blank' href='" + selected_element.data('url') + "'>" + selected_element.data('url') + "</a>" );

		if(selected_element.data('address'))
		{
			div.find("#label-noreg-address").html( selected_element.data('address') + '<br />' );
		}

		Trustindex_Autocomplete.box.hide();

		div.fadeIn();

		Trustindex_Autocomplete.button.addClass("btn-default").removeClass("btn-primary");
	});

	// Show loading text on connect
	jQuery("#trustindex-plugin-settings-page form:not([data-platform='facebook']) .btn-connect").click(function(e){
		let btn = jQuery(this);

		btn.css('pointer-events', 'none');
		btn.addClass("btn-default").removeClass("btn-primary");
		btn.blur();
		TI_manage_dots(btn);

		Trustindex_Autocomplete.button.css('pointer-events', 'none');
		jQuery("#trustindex-plugin-settings-page .btn-check").css('pointer-events', 'none');
	});

	// Show loading text on refresh
	jQuery("#trustindex-plugin-settings-page .btn-refresh").click(function(e) {
		let btn = jQuery(this);

		btn.css('pointer-events', 'none');
		btn.addClass("btn-default").removeClass("btn-primary");
		btn.blur();
		TI_manage_dots(btn);

		jQuery("#trustindex-plugin-settings-page .btn").css('pointer-events', 'none');
	});

	// Check init after click
	jQuery("#trustindex-plugin-settings-page .btn-check").click(function(e) {
		e.preventDefault();

		Trustindex_Autocomplete.check();
	});

	/*************************************************************************/
	/* TOGGLE */
	jQuery("#trustindex-plugin-settings-page .btn-toggle").on('click', function(e) {
		e.preventDefault();

		jQuery(jQuery(this).attr("href")).toggle();

		return false;
	});

	/*************************************************************************/
	/* CONNECT TO TRUSTINDEX */
	var used_emails = [];
	jQuery("#ti-reg-email, #ti-reg-password").blur(function(){

		let email = jQuery("#ti-reg-email").val();

		//if previously checked
		if (jQuery.inArray(email, used_emails) != -1)
		{
			jQuery("#txt-email-used").fadeIn();
			return false;
		}

		jQuery.ajax({
			method: "POST",
			url: "https://admin.trustindex.io/" + "api/userCheckEmail",
			data: { 'email': email, 's': 'wp' },
			dataType: "jsonp",
			success: function(data) {
				//invalid e-mail
				if (data == -1)
				{

				}
				//new e-mail
				else if (data == 0)
				{
					jQuery("#txt-email-used").fadeOut();
				}
				//used e-mail
				else
				{
					let link = jQuery("#txt-email-used").find("a");
					link.html(link.html().replace("$email", email));
					jQuery("#txt-email-used").fadeIn();
					jQuery("#ti-reg-email").val("");

					//register as used email
					used_emails.push(email);
				}
			}
		});
	});

	jQuery("#form-reg").submit(function(e){
		return !jQuery("#txt-email-used").is(":visible");
	});

	/*************************************************************************/
	/* COPY 2 CLIPBOARD */
	jQuery(".btn-copy2clipboard").click(function(e){
		e.preventDefault();

		let obj = jQuery(jQuery(this).attr("href"));
		let text = obj.html() ? obj.html() : obj.val();

		TI_copyTextToClipboard(text);
	});

	/*************************************************************************/
	/* STYLE */
	var apply_style = function() {

		let style_id = jQuery('#ti-style-id').val();
		let box = jQuery('#ti-review-list').closest('.ti-preview-box');

		if(['8', '9', '10', '11', '12', '20', '22'].indexOf(style_id) != -1 && !is_no_reviews_with_filter)
		{
			box.css('width', '30%');
		}
		else if(['6', '7', '24', '25', '26', '27', '28', '29', '35'].indexOf(style_id) != -1 && !is_no_reviews_with_filter)
		{
			box.css('width', '50%');
		}
		else
		{
			box.css('width', 'auto');
		}

		//This is necessary to round up x.5 px width
		box.css('width', box.width());
	};

	/*************************************************************************/
	/* FILTER */
	//Checkbox
	jQuery('.ti-checkbox').on('click', function() {
		let checkbox = jQuery(this).find('input[type=checkbox], input[type=radio]');
		checkbox.prop('checked', !checkbox.prop('checked')).trigger("change");

		return false;
	});

	//Custom select - init
	jQuery('.ti-select').each(function() {
		let el = jQuery(this);
		let selected = el.find('ul li.selected');

		if(selected.length == 0)
		{
			selected = el.find('ul li:first');
		}

		el.data('value', selected.data('value')).find('font').html(selected.html());
	});

	//Custom select - toggle click
	jQuery(document).on('click', '.ti-select', function() {
		let el = jQuery(this);
		el.toggleClass('active');

		if(el.hasClass('active'))
		{
			jQuery(window).unbind().on('click', function(e) {
				if(!jQuery(e.target).is(el) && jQuery(e.target).closest('.ti-select').length == 0)
				{
					el.removeClass('active');
					jQuery(window).unbind();
				}
			});
		}
	});

	//Custom select - select item
	jQuery(document).on('click', '.ti-select li', function() {
		let el = jQuery(this);
		el.parent().parent().data('value', el.data('value')).trigger('change').find('font').html(el.html());

		el.parent().find('li').removeClass('selected');
		el.addClass('selected');
	});

	var is_no_reviews_with_filter = false;

	//Get reviews to memory
	var reviews_el = jQuery('#ti-review-list .ti-widget').clone();

	//Set reviews' rating and empty to attributes
	reviews_el.find('.ti-review-item').each(function() {
		let el = jQuery(this);
		let rating = el.find('.ti-stars .ti-star.f, .stars .ti-star.f').length;

		//Facebook recommendations
		if(el.find('.ti-recommendation-icon.positive').length)
		{
			rating = 5;
		}
		else if(el.find('.ti-recommendation-icon.negative').length)
		{
			rating = 1;
		}

		//Ten scale
		if(el.find('.ti-rating-box').length)
		{
			rating = Math.round(parseFloat(el.find('.ti-rating-box').text()) / 2);
		}

		let selector = '.ti-review-content';
		if(el.find('.ti-review-content .ti-inner').length)
		{
			selector = '.ti-review-content .ti-inner';
		}
		else if(el.find('.ti-review-text').length)
		{
			selector = '.ti-review-text';
		}

		el.attr('data-rating', rating);
		el.attr('data-empty', el.find(selector).text().trim() == "" ? 1 : 0);
	});

	//Set the stars background in the filter for the corresponding platform
	var set_star_background = function() {
		let platform = (jQuery('#ti-filter #show-star').data('platform') || 'google').ucfirst();

		let el = jQuery('<div class="ti-widget" style="display: none"><div class="source-'+ platform +'"><span class="ti-star f"></span><span class="ti-star e"></span></div></div>');
		el.append('body');

		jQuery('body').append(el);
		jQuery('#ti-filter .ti-star.e').css('background', el.find('.ti-star.e').css('background'));
		jQuery('#ti-filter .ti-star.f').css('background', el.find('.ti-star.f').css('background'));

		el.remove();
	};
	set_star_background();

	//Check badge type
	var is_badge_widget = function() {
		let layout_id = jQuery('#ti-review-list .ti-widget').data('layout-id');
		return [11, 12, 20, 22, 24, 25, 26, 27, 28, 29, 35].indexOf(layout_id) != -1;
	};

	//Apply filter when change or init
	var apply_filter = function(init) {
		let style_id = jQuery('#ti-style-id').val();

		//get stars
		let stars = (jQuery('#ti-filter #show-star').data('value') + "").split(',').map(i => parseInt(i));

		//only ratings
		let show_only_ratings = jQuery('#ti-filter-only-ratings').prop('checked');

		//filter removed
		if(!jQuery('#ti-filter').length)
		{
			stars = [ 1, 2, 3, 4, 5 ];
			show_only_ratings = false;
		}

		//remove current review elements
		jQuery('.ti-widget .ti-reviews-container-wrapper .ti-review-item').remove();

		//iterate through stored reviews
		let results = 0;
		reviews_el.find('.ti-review-item').each(function() {
			let el = jQuery(this);

			//check rating
			if(stars.indexOf(el.data('rating')) !== -1)
			{
				//check only ratings
				if(show_only_ratings && el.data('empty'))
				{
					return;
				}

				//return after 5 results (vertical widgets)
				if(['8', '9', '10', '18', '33'].indexOf(style_id) != -1 && results > 4)
				{
					return;
				}

				//clone and append element
				let clone = el.clone();
				jQuery('#ti-review-list .ti-widget .ti-reviews-container-wrapper').append(clone);
				clone.hide();
				clone.fadeIn();

				//increase count
				results++;
			}
		});

		//clear pager interval
		if(typeof Trustindex != "undefined" && Trustindex.intervalPointer)
		{
			clearInterval(Trustindex.intervalPointer);
		}

		//show empty text
		if(results == 0 && !is_badge_widget())
		{
			jQuery('#ti-review-list').hide().next().fadeIn();
			is_no_reviews_with_filter = true;
		}
		else
		{
			jQuery('#ti-review-list').fadeIn().next().hide();
			is_no_reviews_with_filter = false;

			//start pager
			if(init === undefined)
			{
				let dot_container = jQuery('#ti-review-list .ti-widget .ti-controls-dots');
				if(dot_container.length)
				{
					let dot = dot_container.children(":first").clone();
					dot_container.html(" " + dot.removeAttr('data-pager-state')[0].outerHTML + " ");
				}
			}

			if(typeof Trustindex != "undefined")
			{
				Trustindex.init_pager(document.querySelectorAll(".ti-widget"));
				Trustindex.resize_widgets();
			}
		}

		//ajax save
		if(init === undefined)
		{
			jQuery.post('', {
				command: 'save-filter',
				filter: JSON.stringify({
					'stars': stars,
					'only-ratings': show_only_ratings
				})
			});
		}

		apply_style();
	}

	//hooks
	jQuery('#ti-filter #show-star').on('change', () => apply_filter());
	jQuery('#ti-filter-only-ratings').on('change', (e) => {
		e.preventDefault();
		apply_filter();
		return false;
	});

	//init
	if(reviews_el.length)
	{
		apply_filter(true);
		apply_style();
	}

	//Background post save - style and set change
	jQuery("#ti-style-id, #ti-set-id, #ti-lang-id, #ti-dateformat-id, #ti-widget-options input[type=checkbox]:not(.no-form-update)").on('change', function() {
		let form = jQuery(this).closest('form');

		jQuery('li.ti-preview-box').addClass('disabled');
		jQuery.ajax({
			url: form.attr('action'),
			type: 'post',
			dataType: 'application/json',
			data: form.serialize()
		}).always(function() {
			location.reload(true);
		});

		return false;
	});

	//Layout select filter
	jQuery('input[name=layout-select]').on('change', (e) => {
		e.preventDefault();

		let ids = (jQuery('input[name=layout-select]:checked').data('ids') + "").split(',');

		if(ids == "")
		{
			jQuery('.ti-preview-boxes-container').find('.ti-full-width, .ti-half-width').fadeIn();
		}
		else
		{
			jQuery('.ti-preview-boxes-container').find('.ti-full-width, .ti-half-width').hide();
			ids.forEach(function(id) {
				jQuery('.ti-preview-boxes-container').find('.ti-preview-boxes[data-layout-id="'+ id + '"]').parent().fadeIn();
			});
		}

		return false;
	});

	//Free step stepping
	let is_stepping = false;
	jQuery('.ti-free-steps li.done, .ti-free-steps li.active').on('click', function(e) {
		e.preventDefault();

		if(is_stepping)
		{
			return false;
		}

		is_stepping = true;
		window.location.href = jQuery(this).attr('href');

		return false;
	});

	//Set auto active if not present
	if(jQuery('.ti-free-steps li.current').length == 0)
	{
		jQuery('.ti-free-steps li.active:last').addClass('current');
	}

	/*************************************************************************/
	/* MODAL */
	jQuery(document).on('click', '.btn-modal-close', function(event) {
		event.preventDefault();

		jQuery(this).closest('.ti-modal').fadeOut();
	});

	jQuery(document).on('click', '.ti-modal', function(event) {
		event.preventDefault();

		if(!jQuery(event.target).closest('.ti-modal-dialog').length)
		{
			jQuery(this).fadeOut();
		}
	});

	/*************************************************************************/
	/* HIGHLIGHT */
	let highlight_modal = jQuery('#ti-highlight-modal');
	if(highlight_modal.length)
	{
		//show highlight modal
		jQuery(document).on('click', '.btn-highlight', function(event) {
			event.preventDefault();

			let btn = jQuery(this);
			let review_box = btn.closest('tr').find('.ti-review-content');
			let content = review_box.html().replace(/<mark class="ti-highlight">/g, '').replace(/<\/mark>/, ''); // remove current highlight tags

			highlight_modal.fadeIn();
			highlight_modal.find('.ti-highlight-content').html(content);
			highlight_modal.find('.btn-highlight-confirm, .btn-highlight-remove').attr('href', btn.attr('href'));

			// toggle highlight remove button
			if(btn.hasClass('has-highlight'))
			{
				highlight_modal.find('.btn-highlight-remove').show();
			}
			else
			{
				highlight_modal.find('.btn-highlight-remove').hide();
			}
		});

		// highlight save
		jQuery(document).on('click', '.btn-highlight-confirm', function(event) {
			event.preventDefault();

			let btn = jQuery(this);
			let highlight_content = btn.closest('.ti-modal-content').find('.ti-highlight-content');
			let data = TI_highlight_getSelection(highlight_content.get(0));

			if(data.start !== null) {
				data.id = btn.attr('href');
				data['save-highlight'] = 1;

				btn.css('pointer-events', 'none');
				btn.blur();
				TI_manage_dots(btn);
				btn.closest('.ti-modal').find('.btn-text').css('pointer-events', 'none');

				jQuery.ajax({
					method: "POST",
					url: window.location.href,
					data: data
				}).always(function() {
					location.reload(true);
				});
			}
		});

		// highlight remove
		jQuery(document).on('click', '.btn-highlight-remove', function(event) {
			event.preventDefault();

			let btn = jQuery(this);
			let highlight_content = btn.closest('.ti-modal-content').find('.ti-highlight-content');
			let data = TI_highlight_getSelection(highlight_content.get(0));

			btn.css('pointer-events', 'none');
			btn.blur();
			TI_manage_dots(btn);
			btn.closest('.ti-modal').find('.btn-text').css('pointer-events', 'none');

			jQuery.ajax({
				method: "POST",
				url: window.location.href,
				data: {
					id: btn.attr('href'),
					"save-highlight": 1
				}
			}).always(function() {
				location.reload(true);
			});
		});
	}

});

function TI_manage_dots($btn)
{
	let loading_text = $btn.data("loading-text");

	let num_of_dots = ($btn.html().match(new RegExp(/\./, "g")) || []).length;
	let next_dots = [".", "..", "...", ""];

	$btn.html(loading_text + next_dots[num_of_dots]);

	setTimeout(function(){ TI_manage_dots($btn); }, 1000);
}

function decodeHTMLEntities(text) {
	let textArea = document.createElement('textarea');

	textArea.innerHTML = text;

	return textArea.value;
}

function TI_copyTextToClipboard(text)
{
	text = decodeHTMLEntities(text);

	if (!navigator.clipboard)
	{
		//fallback
		var textArea = document.createElement("textarea");
		textArea.value = text;
		textArea.style.position="fixed";  //avoid scrolling to bottom
		document.body.appendChild(textArea);
		textArea.focus();
		textArea.select();

		try {
			var successful = document.execCommand('copy');
			//console.log('Fallback: Copying text command was ' + msg);
		} catch (err) {
			//console.error('Fallback: Oops, unable to copy', err);
		}

		document.body.removeChild(textArea);
		return;
	}
	navigator.clipboard.writeText(text).then(
		function() {/*console.log('Async: Copying to clipboard was successful!');*/},
		function(err) {/*console.error('Async: Could not copy text: ', err);*/}
	);
}