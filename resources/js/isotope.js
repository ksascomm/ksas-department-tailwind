/**
 * File isotope.js.
 *
 * Customized isotope script for People Directory Page Template
 */

jQuery(document).ready(function ($) {
  // initially hide noresult box on page load
  $("#noResult").hide();

  var qsRegex;
  var hashFilter;

  // init Isotope
  var $grid = $("#isotope-list").isotope({
    itemSelector: ".item",
    layoutMode: "fitRows",
    filter: function () {
      var $this = $(this);
      var searchResult = qsRegex ? $this.text().match(qsRegex) : true;
      var hashResult = hashFilter ? $this.is(hashFilter) : true;
      return searchResult && hashResult;
    },
  });

  // use value of search field to filter
  var $quicksearch = $("#id_search").keyup(
    debounce(function () {
      qsRegex = new RegExp($quicksearch.val(), "gi");
      $grid.isotope();

      // display message box if no filtered items
      if (!$grid.data("isotope").filteredItems.length) {
        $("#noResult").show();
      } else {
        $("#noResult").hide();
      }
    })
  );

  // debounce so filtering doesn't happen every millisecond
  function debounce(fn, threshold) {
    var timeout;
    return function debounced() {
      if (timeout) {
        clearTimeout(timeout);
      }
      function delayed() {
        fn();
        timeout = null;
      }
      setTimeout(delayed, threshold || 100);
    };
  }

  // Wire filter buttons to generate URL hash
  $("#filters button").on("click", function (event) {
    event.preventDefault();
    var $this = $(this);

    if ($this.attr("aria-pressed") === "true") {
      // If already active, uncheck it
      location.hash = "filter=*";
    } else {
      var filterAttr = $this.attr("data-filter");
      location.hash = "filter=" + encodeURIComponent(filterAttr);
    }
  });

  // Pass filter value to Isotope to repaint.
  function onHashChange() {
    hashFilter = getHashFilter();
    var $filterButtons = $("#filters button");

    if (hashFilter) {
      // 1. Reset all buttons in the filter group
      $filterButtons.attr("aria-pressed", "false").removeClass("is-checked");

      // 2. Set the active button based on the hash
      var $activeButton = $filterButtons.filter('[data-filter="' + hashFilter + '"]');
      
      if ($activeButton.length) {
        $activeButton.attr("aria-pressed", "true").addClass("is-checked");
      }

      $grid.isotope();
    } else {
      // If no hash, ensure nothing is pressed (all results shown)
      $filterButtons.attr("aria-pressed", "false").removeClass("is-checked");
      $grid.isotope({ filter: '*' });
    }
  }

  // Grab filter value from URL hash.
  function getHashFilter() {
    var currentHash = location.hash.match(/filter=([^&]+)/i);
    var filterValue = currentHash && currentHash[1];
    return filterValue ? decodeURIComponent(filterValue) : null;
  }

  onHashChange();
  window.onhashchange = onHashChange;

  // Window Load logic
  $(window).on("load", function () {
    $("#isotope-list").isotope();
    setTimeout(function () {
      $("#isotope-list").removeClass("loading");
    }, 1000);
  });

  // Data Layer / Analytics Logic
  (function() {
    var searchField = document.querySelector('#id_search'),
      timeout = 1500,
      minLength = 3;
  
    var textEntered = false;
    var timer, searchText;
    
    var handleInput = function() {
      searchText = searchField ? searchField.value : '';
      if (searchText.length < minLength) { return; }
      window.dataLayer.push({
        'event': 'peopledirectoryInput',
        'searchTerm': searchText
      });
      textEntered = false;
    };
    
    var startTimer = function(e) {
      textEntered = true;
      window.clearTimeout(timer);
      if (e.keyCode === 13) {
        handleInput();
        return;
      }
      timer = setTimeout(handleInput, timeout);
    };
    
    if (searchField !== null) {
      searchField.addEventListener('keydown', startTimer, true);
      searchField.addEventListener('blur', function() {
        if (textEntered) {
          window.clearTimeout(timer);
          handleInput();
        }
      }, true);
    }
  })();
});