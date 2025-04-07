const fs = require('fs');
const path = require('path');

const dataPath = path.join(__dirname, 'paintings.json');
let paintings = [];

module.exports = {
  getAll: () => paintings,

  getById: (id) => {
    return paintings.find(p => p.id.toString() === id.toString());
  },

  getByGalleryId: (galleryId) => {
    return paintings.filter(p => p.gallery.id.toString() === galleryId.toString());
  },

  getByArtistId: (artistId) => {
    return paintings.filter(p => p.artist.id.toString() === artistId.toString());
  },

  getByYearRange: (min, max) => {
    const minYear = parseInt(min);
    const maxYear = parseInt(max);
    return paintings.filter(p => typeof p.yearOfWork === 'number' && p.yearOfWork >= minYear && p.yearOfWork <= maxYear);
  }
};
