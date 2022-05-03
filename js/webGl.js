import {
    AmbientLight,
    DirectionalLight,
    Matrix4,
    PerspectiveCamera,
    Scene,
    WebGLRenderer,
} from "three";

import { GLTFLoader } from "three/examples/jsm/loaders/GLTFLoader";

const myLatLng = { lat: 45.757186, lng: 4.836875 };

let map; //stock la carte
const mapOptions = { //options de la carte
    tilt: 0,
    heading: 0,
    zoom: 19,
    center: myLatLng,
    mapId: "c05678304c50894a",
    // disable interactions due to animation loop and moveCamera
    disableDefaultUI: true,
    gestureHandling: "none",
    keyboardShortcuts: false,
};

// Initialize the map
function initMap() {
    // Create a map object and specify the DOM element for display.
    map = new google.maps.Map(document.getElementById("map"), {mapOptions});
    initWebglOverlayView(map);
}


function initWebglOverlayView(map) {
    let scene, renderer, camera, loader;
    const webglOverlayView = new google.maps.WebGLOverlayView();

    webglOverlayView.onAdd = () => {
        // Set up the scene.
        scene = new Scene();
        camera = new PerspectiveCamera();

        const ambientLight = new AmbientLight(0xffffff, 0.75); // Soft white light.

        scene.add(ambientLight);

        const directionalLight = new DirectionalLight(0xffffff, 0.25);

        directionalLight.position.set(0.5, -1, 0.5);
        scene.add(directionalLight);
        // Load the model.
        loader = new GLTFLoader();

        const source =
            "Assets/3dModels/electric_scooter/scene.gltf";

        loader.load(source, (gltf) => {
            gltf.scene.scale.set(10, 10, 10);
            gltf.scene.rotation.x = Math.PI; // Rotations are in radians.
            scene.add(gltf.scene);
        });
    };

    webglOverlayView.onContextRestored = ({ gl }) => {
        // Create the js renderer, using the
        // maps's WebGL rendering context.
        renderer = new WebGLRenderer({
            canvas: gl.canvas,
            context: gl,
            ...gl.getContextAttributes(),
        });
        renderer.autoClear = false;
        // Wait to move the camera until the 3D model loads.
        loader.manager.onLoad = () => {
            renderer.setAnimationLoop(() => {
                webglOverlayView.requestRedraw();

                const { tilt, heading, zoom } = mapOptions;

                map.moveCamera({ tilt, heading, zoom });
                // Rotate the map 360 degrees.
                if (mapOptions.tilt < 67.5) {
                    mapOptions.tilt += 0.5;
                } else if (mapOptions.heading <= 360) {
                    mapOptions.heading += 0.2;
                    mapOptions.zoom -= 0.0005;
                } else {
                    renderer.setAnimationLoop(null);
                }
            });
        };
    };

    webglOverlayView.onDraw = ({ gl, transformer }) => {
        const latLngAltitudeLiteral = {
            lat: mapOptions.center.lat,
            lng: mapOptions.center.lng,
            altitude: 100,
        };
        // Update camera matrix to ensure the model is georeferenced correctly on the map.
        const matrix = transformer.fromLatLngAltitude(latLngAltitudeLiteral);

        camera.projectionMatrix = new Matrix4().fromArray(matrix);
        webglOverlayView.requestRedraw();
        renderer.render(scene, camera);
        // Sometimes it is necessary to reset the GL state.
        renderer.resetState();
    };

    webglOverlayView.setMap(map);
}

// affiche la carte
window.initMap = initMap;