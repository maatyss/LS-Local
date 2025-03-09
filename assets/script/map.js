let maps = document.querySelectorAll('.map')
let addMarker = document.querySelector('#addMarker')
let cancelAddMarker = document.querySelector('#cancelAddMarker')
let addMarkerInstruction = document.querySelector('#addMarkerInstruction')
let markersLists = document.querySelectorAll('.markersList')

function choosecoordinateForMarker(e) {
  
  let posX = Math.trunc((e.offsetX/e.target.width)*Math.pow(10, 7))/Math.pow(10, 7)
  let posY = Math.trunc((e.offsetY/e.target.height)*Math.pow(10, 7))/Math.pow(10, 7)
  let region = e.target.dataset.region
  
  window.location.assign('/create/marker/' + region + '/' + posX + '/' + posY)
}

if(addMarker && cancelAddMarker && addMarkerInstruction) {
  addMarker.addEventListener('click', () => {
    addMarker.classList.toggle('invisible')
    cancelAddMarker.classList.toggle('invisible')
    addMarkerInstruction.classList.toggle('invisible')
    
    if(markersLists) {
      markersLists.forEach((markerList) => {
        markerList.classList.toggle('hidden')
      })
    }
    
    if(maps) {
      maps.forEach((map) => {
        map.classList.toggle('hover:cursor-pointer')
        map.addEventListener( 'click', choosecoordinateForMarker)
      })
    }
    
  })
  
  cancelAddMarker.addEventListener('click', () => {
    addMarker.classList.toggle('invisible')
    cancelAddMarker.classList.toggle('invisible')
    addMarkerInstruction.classList.toggle('invisible')
    
    if(markersLists) {
      markersLists.forEach((markerList) => {
        markerList.classList.toggle('hidden')
      })
    }
    
    if(maps) {
      maps.forEach((map) => {
        map.classList.toggle('hover:cursor-pointer')
        map.removeEventListener( 'click', choosecoordinateForMarker)
      })
    }
  })
  
  
}


let explanationShow = document.querySelector('#explanationShow')
let explanations = document.querySelector('#explanations')
let explanationShowPath = document.querySelector('#explanationShowPath')
let arrowup = "M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2 160 448c0 17.7 14.3 32 32 32s32-14.3 32-32l0-306.7L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"
let arrowdown = "M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6" +
  " 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"

if(explanationShow && explanations && explanationShowPath) {
  explanationShow.addEventListener('click', () => {
    (explanationShowPath.getAttribute('d') !== arrowup)? explanationShowPath.setAttribute('d', arrowup) : explanationShowPath.setAttribute('d', arrowdown)
    explanations.classList.toggle('hidden')
    explanations.classList.toggle('flex')
  })
  
}

let markers = document.querySelectorAll('.marker')

if (markers) {
  markers.forEach((marker) => {
    let markerIcon = marker.querySelector('i')
    
    let posX = Math.round(marker.parentElement.offsetWidth * marker.dataset.posx) - (markerIcon.getBoundingClientRect().width/2)
    let posY = Math.round(marker.parentElement.offsetHeight * marker.dataset.posy) - (markerIcon.getBoundingClientRect().height/2)

    marker.style.top = posY + 'px'
    marker.style.left = posX + 'px'
    marker.classList.add('visible')
    marker.classList.remove('opacity-0')
    
    marker.addEventListener('mouseover', () => {
      let cardMarker = marker.querySelector('#cardMarker_'+marker.dataset.id)
      cardMarker.classList.remove('hidden')
      cardMarker.classList.add('flex')
    })
    marker.addEventListener('mouseleave', () => {
      let cardMarker = marker.querySelector('#cardMarker_'+marker.dataset.id)
      cardMarker.classList.add('hidden')
      cardMarker.classList.remove('flex')
    })
  })
  
  if(markersLists) {
    markersLists.forEach((markerList) => {
      markerList.classList.toggle('invisible')
    })
  }
}




function showPreview(event, id){
  if(event.target.files.length > 0){
    let preview = document.querySelector('#'+id+'-preview')
    let displayName = document.querySelector('#'+id+'-name')
    
    preview.src = URL.createObjectURL(event.target.files[0]);
    displayName.textContent = event.target.files[0].name
  }
}

// Obligation to declare global function because of the webpack
global.showPreview = showPreview