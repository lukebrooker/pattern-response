# Pattern Response

## How to use

Create folders in the patterns folder, place html files in each folder. The html files can contain html, css and/or a description.

To display a description about the contents of the folder, include it in a info.txt file in the base of that folder.

### Pattern Structure

#### Description/Info
To add a description use html comments.
eg.
<!-- INFO! This is the description /INFO -->

Use the start and ending INFO tags to declare a description

#### HTML
To add HTML just add it as usual, make sure it comes after the INFO comments but before the CSS comments.

#### CSS
To add CSS use html comments.

eg.
<!--CSS!
h1, h2, h3, h4, h5, h6 {
	font-weight: bold;
}
/CSS-->

The other option is to include a CSS file in the same folder as the html file with the exact same name as the html file, except with the extension .css

#### Pattern Notes
INFO and CSS is not required as long as it follows the same structure. eg. If there is no INFO needed just include the HTML *then* the CSS.

### Styling

The CSS in the documentation is not included in the page markup. To style the elements in Pattern Response change the line in index.php from:

<!-- Style guide styles -->
<!-- <link rel="stylesheet" href="custom/css/custom.css"> -->

To include the location of your css file and uncomment it.

## Notes

This is by no means perfect, actually it's probably *much* less than perfect. I am happy for others to give idea and add to the project.
**Please Note:** This is my first Github project and I'm really not sure how to do this.