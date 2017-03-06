These files contain SVG path elements to render the various components
of the container.  The renderer applies style to 4 distinct elements:

  1) container - This is the container itself and is basically 
     assumed to be glass by the renderer.
  2) outline - An outline of the container.  For everything here
     created, this is just a copy of the container path, but it
     is styled differently by the renderer.
  3) liquid - The liquid component.  The render applies the rgb estimate
     of the srm value to this component.
  4) foam - The foam or head.  The renderer crudely applies 3 shades of 
     color to the foam based on the red value of the above rgb component.

You can add other containers by drawing these 4 paths in your favorite SVG
editor, then manually editing out all the containing metadata.  Set the id 
of each path as defined above and be sure to remove any style information.
