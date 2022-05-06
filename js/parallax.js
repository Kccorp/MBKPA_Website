const routeHuman = {
    curviness: 1.25,
    autoRotate: true,
    values: [
        {x: window.innerWidth, y: 0},
    ]
}

const tween = new TimelineLite();

tween.add(
    TweenLite.to('.human', 1, {
        bezier : routeHuman,
        ease : Power1.easeInOut
    })
);


const controller = new ScrollMagic.Controller();

const scene = new ScrollMagic.Scene({
    triggerElement : ".animation",
    duration : 1000,
    triggerHook : 0
})
    .setTween()
    .addIndicators()
    .addTo(controller);

