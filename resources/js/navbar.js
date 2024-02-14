/**
 * File navbar.js.
 *
 * Customized script for Accessible WordPress Navigation Menu 
 * 
 * @link https://gist.github.com/SteveJonesDev/ce8bf0219e4ebe5582454022e429ef07
 */

document.addEventListener('DOMContentLoaded', function() {

    // Getting main menu elements
    var menuContainer = document.querySelector('.menu-container');
    var menuToggle = menuContainer.querySelector('.menu-button');
    var siteHeaderMenu = menuContainer.querySelector('#site-header-menu');
    var siteNavigation = menuContainer.querySelector('#site-navigation');
    
    // If the menu toggle button exists, set up its behaviors
    if (menuToggle) {
        // Initial ARIA attribute setup for accessibility
        menuToggle.setAttribute('aria-expanded', 'false');
        siteNavigation.setAttribute('aria-expanded', 'false');

        // Event listener for main menu toggle button
        menuToggle.addEventListener('click', function() {
            // Toggle visual states for the button and menu
            this.classList.toggle('toggled-on');
            siteHeaderMenu.classList.toggle('toggled-on');
            
            // Determine and set the new expanded state for ARIA
            var isExpanded = this.getAttribute('aria-expanded') === 'true';
            var newExpandedState = isExpanded ? 'false' : 'true';

            // Update ARIA attributes
            this.setAttribute('aria-expanded', newExpandedState);
            siteNavigation.setAttribute('aria-expanded', newExpandedState);
        });
    }

    // Set up dropdown toggle buttons for menu items with children
    var menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children > a');
    menuItemsWithChildren.forEach(function(item) {
        var linkText = item.textContent;
        
        // Create the dropdown toggle button
        var dropdownToggle = document.createElement('button');
        dropdownToggle.className = 'dropdown-toggle';
        dropdownToggle.setAttribute('aria-expanded', 'false');
        
        // Set ARIA label for accessibility
        dropdownToggle.setAttribute('aria-label', linkText + ' submenu');
        
        // Insert the dropdown button after the menu item
        item.insertAdjacentElement('afterend', dropdownToggle);

        // Set up behavior when the dropdown button is clicked
        dropdownToggle.addEventListener('click', function() {
            console.log('Button clicked');
        
            // Determine the expanded state of the dropdown
            var isExpanded = this.getAttribute('aria-expanded');

            // Toggle the dropdown's expanded state
            if (isExpanded === 'true') {
                this.setAttribute('aria-expanded', 'false');
            } else {
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // Toggle dropdowns behavior
    var dropdownToggles = siteHeaderMenu.querySelectorAll('.dropdown-toggle');
    dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation(); // Prevent event from bubbling
            
            // Toggle the clicked dropdown
            this.classList.toggle('toggled-on');
            var nextSubMenu = this.nextElementSibling;
            if (nextSubMenu && nextSubMenu.classList.contains('sub-menu')) {
                nextSubMenu.classList.toggle('toggled-on');
            }

            // Update the ARIA expanded state of the dropdown
            var isExpanded = (this.getAttribute('aria-expanded') === 'false') ? 'true' : 'false';
            this.setAttribute('aria-expanded', isExpanded);
            
            // Close other dropdowns on the same level to avoid multiple open dropdowns
            var siblingToggles = Array.from(this.parentElement.parentElement.children)
                .map(el => el.querySelector('.dropdown-toggle'))
                .filter(el => el !== null && el !== this);
            
            siblingToggles.forEach(sibToggle => {
                sibToggle.classList.remove('toggled-on');
                var sibSubMenu = sibToggle.nextElementSibling;
                if (sibSubMenu && sibSubMenu.classList.contains('sub-menu')) {
                    sibSubMenu.classList.remove('toggled-on');
                }
                sibToggle.setAttribute('aria-expanded', 'false');
            });
        });
    });

    // Indicate that a menu has a sub-menu
    var subMenus = document.querySelectorAll('.sub-menu .menu-item-has-children');
    subMenus.forEach(function(subMenu) {
        subMenu.parentElement.classList.add('has-sub-menu');
    });

    // Keyboard navigation setup for menu
    var menuLinksAndDropdownToggles = document.querySelectorAll('.menu-item a, button.dropdown-toggle');
    menuLinksAndDropdownToggles.forEach(function(element) {
        element.addEventListener('keydown', function(e) {
            var key = e.keyCode;
            
            // Key handling for improved keyboard navigation
            if (![27, 37, 38, 39, 40].includes(key)) {
                return;
            }
            
            // Handle different keys for navigation
            switch(key) {
                case 27: // Escape: Close dropdown or main menu
                    e.preventDefault();
                    e.stopPropagation();
                    var parentDropdown = this.closest('ul').previousElementSibling;
                    if (parentDropdown && parentDropdown.classList.contains('dropdown-toggle') && parentDropdown.classList.contains('toggled-on')) {
                        parentDropdown.focus();
                        parentDropdown.click();
                    } else if (!parentDropdown) {
                        // If no parent dropdown found, close the main menu.
                        if (menuToggle && menuToggle.classList.contains('toggled-on')) {
                            menuToggle.click();
                            menuToggle.focus();
                        }
                    }
                    break;
                
                case 37: // Left arrow: Move focus to the previous item
                    e.preventDefault();
                    if (this.classList.contains('dropdown-toggle')) {
                        this.previousElementSibling.focus();
                    } else {
                        var prevSibling = this.parentElement.previousElementSibling;
                        if (prevSibling && prevSibling.querySelector('button.dropdown-toggle')) {
                            prevSibling.querySelector('button.dropdown-toggle').focus();
                        } else if (prevSibling && prevSibling.querySelector('a')) {
                            prevSibling.querySelector('a').focus();
                        }
                    }
                    break;
                
                case 39: // Right arrow: Move focus to the next item or enter a submenu
                    e.preventDefault();
                    if (this.nextElementSibling && this.nextElementSibling.matches('button.dropdown-toggle')) {
                        this.nextElementSibling.focus();
                    } else {
                        var nextSibling = this.parentElement.nextElementSibling;
                        if (nextSibling) {
                            nextSibling.querySelector('a').focus();
                        }
                    }
                    if (this.matches('ul.sub-menu .dropdown-toggle.toggled-on')) {
                        this.parentElement.querySelector('ul.sub-menu li:first-child a').focus();
                    }
                    break;
            
                case 40: // Down arrow: Move focus to the next item or submenu
                    e.preventDefault();
                    if (this.nextElementSibling) {
                        var firstChildLink = this.nextElementSibling.querySelector('li:first-child a');
                        if (firstChildLink) {
                            firstChildLink.focus();
                        }
                    } else {
                        var nextElem = this.parentElement.nextElementSibling;
                        if (nextElem) {
                            nextElem.querySelector('a').focus();
                        }
                    }
                    break;
            
                case 38: // Up arrow: Move focus to the previous item or exit a submenu
                    e.preventDefault();
                    var prevElem = this.parentElement.previousElementSibling;
                    if (prevElem) {
                        prevElem.querySelector('a').focus();
                    } else {
                        var closestUl = this.closest('ul');
                        if (closestUl && closestUl.previousElementSibling.matches('.dropdown-toggle.toggled-on')) {
                            closestUl.previousElementSibling.focus();
                        }
                    }
                    break;
            }
        });
    });
});