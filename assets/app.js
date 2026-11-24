import './stimulus_bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
// Randomizer de vinyles
const platine = document.getElementById('platine');

if (platine) {
    const pochettes = JSON.parse(platine.dataset.pochettes);
    const etiquette = platine.querySelector('.etiquette');
    const sansAnimation = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let actuelle = -1;

    // Précharge les images pour éviter un flash blanc au changement
    pochettes.forEach((src) => { new Image().src = src; });

    function imageAuHasard() {
        if (pochettes.length < 2) return 0;
        let i;
        do { i = Math.floor(Math.random() * pochettes.length); } while (i === actuelle);
        return i;
    }

    function poserImage() {
        actuelle = imageAuHasard();
        etiquette.style.setProperty('--pochette', `url("${pochettes[actuelle]}")`);
    }

    function changerDisque() {
        if (sansAnimation) { poserImage(); return; }
        platine.classList.add('sortie');
    }

    platine.addEventListener('animationend', (e) => {
        if (e.target !== platine) return;
        if (platine.classList.contains('sortie')) {
            poserImage();
            platine.classList.replace('sortie', 'entree');
        } else {
            platine.classList.remove('entree');
        }
    });

    poserImage();
    setInterval(changerDisque, 8000);
}