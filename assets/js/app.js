require('../css/app.scss');

// loads the jquery package from node_modules
var $ = require('jquery');
require('bootstrap-sass');

var $collectionHolder;

// setup an "add a Element" link
var $addXliffElementLink = $('<div class="col-md-12"><div class="form-group"><a href="#" class="collection-add btn btn-default "><span class="glyphicon glyphicon-plus-sign"></span></a></div></div>');
var $newLinkButton = $('<div class="row"></div>').append($addXliffElementLink);

jQuery(document).ready(function() {
    // Get the div that holds the collection of Xliff-Elements
    $collectionHolder = $('div.elements');

    // add a delete link to all of the existing Xliff-Elements
    $collectionHolder.find('div.row').each(function() {
        addXliffElementFormDeleteLink($(this));
    });

    // add the "add a Element" anchor and div to the elements
    $collectionHolder.append($newLinkButton);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addXliffElementLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new elements form
        addXliffElementForm($collectionHolder, $newLinkButton);
    });
});

function addXliffElementForm($collectionHolder, $newLinkButton) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an div, before the "Add a Xliff Element" link div
    var $newFormDiv = $('<div class="row"></div>').append(newForm);
    $newLinkButton.before($newFormDiv);

    // add a delete link to the new form
    addXliffElementFormDeleteLink($newFormDiv);
}

function addXliffElementFormDeleteLink($xliffElementFormDiv) {
    var $removeFormButton = $('<div class="col-md-3"><label class="form-control-label">Delete</label><br><a href="#" class="collection-remove btn btn-default" title="Delete"><span class="glyphicon glyphicon-trash"></span></a></div>');
    $xliffElementFormDiv.append($removeFormButton);

    $removeFormButton.on('click', function(e) {
        // remove the div for the Xliff-Element form
        $xliffElementFormDiv.remove();
    });
}
