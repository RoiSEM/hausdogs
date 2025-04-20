/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for mobile devices.
 */
(function() {
	const siteNavigation = document.getElementById('site-navigation');
	const menuToggle = siteNavigation ? siteNavigation.querySelector('.menu-toggle') : null;
	const primaryMenu = document.getElementById('primary-menu');

	// Return early if the navigation elements don't exist.
	if (!siteNavigation || !menuToggle || !primaryMenu) {
		return;
	}

	// Toggle the .toggled class on menu click and set the aria-expanded attribute.
	menuToggle.addEventListener('click', function() {
		const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
		
		// Toggle menu visibility
		primaryMenu.classList.toggle('toggled');
		menuToggle.setAttribute('aria-expanded', !isExpanded);
	});

	// Handle submenu toggling for mobile
	const menuItemsWithChildren = siteNavigation.querySelectorAll('.menu-item-has-children > a');
	
	// Add dropdown toggles to menu items with children
	menuItemsWithChildren.forEach(function(menuItem) {
		// Create the dropdown toggle button
		const dropdownToggle = document.createElement('button');
		dropdownToggle.classList.add('dropdown-toggle');
		dropdownToggle.setAttribute('aria-expanded', 'false');
		
		// Add click event to the dropdown toggle
		dropdownToggle.addEventListener('click', function(e) {
			e.preventDefault();
			const isExpanded = this.getAttribute('aria-expanded') === 'true';
			const subMenu = this.parentNode.querySelector('.sub-menu');
			
			// Toggle submenu visibility
			if (subMenu) {
				subMenu.classList.toggle('toggled');
				this.setAttribute('aria-expanded', !isExpanded);
			}
		});
		
		// Append the toggle after the menu item link
		menuItem.parentNode.insertBefore(dropdownToggle, menuItem.nextSibling);
	});

	// Close submenus when clicking outside
	document.addEventListener('click', function(event) {
		const isClickInside = siteNavigation.contains(event.target);
		
		if (!isClickInside) {
			const openMenus = siteNavigation.querySelectorAll('.toggled');
			openMenus.forEach(function(menu) {
				menu.classList.remove('toggled');
			});
			
			// Reset expanded state for dropdown toggles
			const expandedButtons = siteNavigation.querySelectorAll('[aria-expanded="true"]');
			expandedButtons.forEach(function(button) {
				button.setAttribute('aria-expanded', 'false');
			});
		}
	});

	// Add keyboard navigation support
	siteNavigation.addEventListener('keydown', function(e) {
		const activeElement = document.activeElement;
		
		// Handle ESC key
		if (e.key === 'Escape') {
			if (menuToggle.getAttribute('aria-expanded') === 'true') {
				primaryMenu.classList.remove('toggled');
				menuToggle.setAttribute('aria-expanded', 'false');
				menuToggle.focus();
			} else {
				const parent = activeElement.closest('.menu-item-has-children');
				if (parent) {
					const toggle = parent.querySelector('.dropdown-toggle');
					const subMenu = parent.querySelector('.sub-menu');
					
					if (toggle && subMenu && subMenu.classList.contains('toggled')) {
						subMenu.classList.remove('toggled');
						toggle.setAttribute('aria-expanded', 'false');
						toggle.focus();
					}
				}
			}
		}
	});
})();
