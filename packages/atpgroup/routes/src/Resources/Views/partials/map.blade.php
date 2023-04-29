<x-maps.open-street-map.routing 
  :coordinates="json_encode($coordinates)" 
  :stations="json_encode($stations)" 
  :zoom="10" 
  width="100%" 
  height="450px;" 
/>