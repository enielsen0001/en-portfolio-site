/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	const siteNavigation = document.getElementById( 'site-navigation' );

	// Return early if the navigation doesn't exist.
	if ( ! siteNavigation ) {
		return;
	}

	const button = siteNavigation.getElementsByTagName( 'button' )[ 0 ];

	// Return early if the button doesn't exist.
	if ( 'undefined' === typeof button ) {
		return;
	}

	const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];
	const menuContainer = siteNavigation.getElementsByClassName('menu-main-menu-container')[0];
	const menuLinks = menu.getElementsByTagName('a');

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( ! menu.classList.contains( 'nav-menu' ) ) {
		menu.classList.add( 'nav-menu' );
	}

	menu.setAttribute('aria-hidden', true);

	// Toggle the .toggled class and the aria-expanded value each time the button is clicked.
	button.addEventListener( 'click', function() {
		siteNavigation.classList.toggle( 'toggled' );

		if ( button.getAttribute( 'aria-expanded' ) === 'true' ) {

			menuContainer.classList.remove('menu-open');
			menu.classList.remove('menu-open');

			button.setAttribute( 'aria-expanded', 'false' );
			menuContainer.setAttribute('aria-hidden', 'true');

			Array.from(menuLinks).forEach(item => {
				item.setAttribute('tabindex', '-1');
			});

			menu.setAttribute('aria-hidden', 'true');
		} else {
			button.setAttribute( 'aria-expanded', 'true' );

			menuContainer.classList.add('menu-open');
			menu.classList.add('menu-open');

			menu.removeAttribute('aria-hidden');
			menuContainer.removeAttribute('aria-hidden');

			Array.from(menuLinks).forEach(item => {
				item.removeAttribute('tabindex');
			});
		}
	} );

	function updateMenuAccessibility(e) {
		if (e.matches) {
			if (button.getAttribute('aria-expanded') === 'true') {
				menuContainer.removeAttribute('aria-hidden');
				menu.removeAttribute('aria-hidden');

				Array.from(menuLinks).forEach(item => {
					item.removeAttribute('tabindex');
				});

			} else {
				menuContainer.setAttribute('aria-hidden', 'true');
				menu.setAttribute('aria-hidden', 'true');

				Array.from(menuLinks).forEach(item => {
					item.setAttribute('tabindex', '-1');
				});
			}

			menuContainer.classList.add('js-is-mobile-menu');
			button.classList.remove('js-hide-toggle');
		} else {
			menuContainer.removeAttribute('aria-hidden');
			menu.removeAttribute('aria-hidden');

			Array.from(menuLinks).forEach(item => {
				item.removeAttribute('tabindex');
			});

			button.classList.add('js-hide-toggle');
			menuContainer.classList.remove('js-is-mobile-menu');
		}
	}

	// Initial check
	let mql = window.matchMedia("(max-width: 576px)");
	updateMenuAccessibility(mql);

	// Listen for breakpoint changes
	mql.addEventListener('change', updateMenuAccessibility);

	// Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
	document.addEventListener( 'click', function( event ) {
		const isClickInside = siteNavigation.contains( event.target );

		if ( ! isClickInside ) {
			siteNavigation.classList.remove( 'toggled' );
			button.setAttribute( 'aria-expanded', 'false' );
		}
	} );

	// Get all the link elements within the menu.
	const links = menu.getElementsByTagName( 'a' );

	// Get all the link elements with children within the menu.
	const linksWithChildren = menu.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

	// Toggle focus each time a menu link is focused or blurred.
	for ( const link of links ) {
		link.addEventListener( 'focus', toggleFocus, true );
		link.addEventListener( 'blur', toggleFocus, true );
	}

	// Toggle focus each time a menu link with children receive a touch event.
	for ( const link of linksWithChildren ) {
		link.addEventListener( 'touchstart', toggleFocus, false );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		if ( event.type === 'focus' || event.type === 'blur' ) {
			let self = this;
			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( ! self.classList.contains( 'nav-menu' ) ) {
				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					self.classList.toggle( 'focus' );
				}
				self = self.parentNode;
			}
		}

		if ( event.type === 'touchstart' ) {
			const menuItem = this.parentNode;
			event.preventDefault();
			for ( const link of menuItem.parentNode.children ) {
				if ( menuItem !== link ) {
					link.classList.remove( 'focus' );
				}
			}
			menuItem.classList.toggle( 'focus' );
		}
	}
}() );
