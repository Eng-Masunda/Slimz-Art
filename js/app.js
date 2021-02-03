/*=====================================================
				CODE FOR LOADING PAGE LOADER
=======================================================*/
window.addEventListener("load", () => {
	const loader = document.querySelector(".loader");

	if (loader.classList.contains("hide-loader")) {
		loader.classList.remove("hide-loader");
	} else {
		loader.classList.add("hide-loader");
	}
});

document.addEventListener("DOMContentLoaded", () => {
	/*=====================================================
					CODE TO ANIMATE IMAGES 
	=======================================================*/
	//Function to animate the sketch Artist image
	function animateSketchArtistImg() {
		var sketchImg1 = document.querySelector(".sketch-img1");
		var sketchImg2 = document.querySelector(".sketch-img2");
		var itemPosition1 = sketchImg1.getBoundingClientRect().top;
		var itemPosition2 = sketchImg2.getBoundingClientRect().top;
		var screenPosition = window.innerHeight / 1.1;

		if (itemPosition1 < screenPosition) {
			sketchImg1.classList.add("re-appear");
		}

		if (itemPosition2 < screenPosition) {
			sketchImg2.classList.add("re-appear");
		}
	}
	window.addEventListener("scroll", animateSketchArtistImg);

	//Function to animate cartoonist image
	function animateCartoonistImg() {
		const cartoonImage = document.querySelector(".cartoon-img");
		var cartoonImgPosition = cartoonImage.getBoundingClientRect().top;
		var screenPosition = window.innerHeight / 1.1;

		if (cartoonImgPosition < screenPosition) {
			cartoonImage.classList.add("animate-spin");
		}
	}
	window.addEventListener("scroll", animateCartoonistImg);

	//Function to animate the painter image
	function animatePainterImg() {
		var painterImg1 = document.querySelector(".painter-img1");
		var painterImg2 = document.querySelector(".painter-img2");
		var itemPosition1 = painterImg1.getBoundingClientRect().top;
		var itemPosition2 = painterImg2.getBoundingClientRect().top;
		var screenPosition = window.innerHeight / 1.1;

		if (itemPosition1 < screenPosition) {
			painterImg1.classList.add("re-appear");
		}

		if (itemPosition2 < screenPosition) {
			painterImg2.classList.add("re-appear");
		}
	}
	window.addEventListener("scroll", animatePainterImg);

	//Function to animate digital illustrator image
	function animateDigitalImg() {
		const digitalImage = document.querySelector(".digital-img");
		var digitalImgPosition = digitalImage.getBoundingClientRect().top;
		var screenPosition = window.innerHeight / 1.1;

		if (digitalImgPosition < screenPosition) {
			digitalImage.classList.add("animate-spin");
		}
	}
	window.addEventListener("scroll", animateDigitalImg);

	//Function to animate the graphics designer images
	function animateDesignerImg() {
		var designerImg1 = document.querySelector(".designer-img1");
		var designerImg2 = document.querySelector(".designer-img2");
		var itemPosition1 = designerImg1.getBoundingClientRect().top;
		var itemPosition2 = designerImg2.getBoundingClientRect().top;
		var screenPosition = window.innerHeight / 1.1;

		if (itemPosition1 < screenPosition) {
			designerImg1.classList.add("re-appear");
		}

		if (itemPosition2 < screenPosition) {
			designerImg2.classList.add("re-appear");
		}
	}
	window.addEventListener("scroll", animateDesignerImg);

	//Function to animate Artist image
	function animateArtistImg() {
		const artistImage = document.querySelector(".artist-img");
		var artistImgPosition = artistImage.getBoundingClientRect().top;
		var screenPosition = window.innerHeight / 1.1;

		if (artistImgPosition < screenPosition) {
			artistImage.classList.add("animate-spin");
		}
	}
	window.addEventListener("scroll", animateArtistImg);

	/*=====================================================
				CODE TO ANIMATE TEXT 
=======================================================*/

	//function to animate the text in intro section
	function textAppear(paragraph, heading) {
		var paragraphTxt = document.querySelector(paragraph);
		var headerTxt = document.querySelector(heading);
		paragraphTxt.classList.add("text-re-appear");
		headerTxt.classList.add("text-re-appear");
	}

	//animate sketch artist header and paragraph
	var sketchImg2 = document.querySelector(".sketch-img2");
	sketchImg2.addEventListener("animationend", function () {
		textAppear(".sketch-artist-content", ".sketch-artist-heading");
	});

	//animate cartoonist header and paragraph
	var cartoonImage = document.querySelector(".cartoon-img");
	cartoonImage.addEventListener("animationend", function () {
		textAppear(".cartoon-content", ".cartoon-header");
	});

	//animate painter header and paragraph
	var painterImage2 = document.querySelector(".painter-img2");
	painterImage2.addEventListener("animationend", function () {
		textAppear(".painter-content", ".painter-header");
	});

	//animate digital-illustrator header and paragraph
	var digitalImage = document.querySelector(".digital-img");
	digitalImage.addEventListener("animationend", function () {
		textAppear(".digital-content", ".digital-header");
	});

	//animate painter header and paragraph
	var designerImage2 = document.querySelector(".designer-img2");
	designerImage2.addEventListener("animationend", function () {
		textAppear(".designer-content", ".designer-header");
	});

	//animate Artist header and paragraph
	var artistImage = document.querySelector(".artist-img");
	artistImage.addEventListener("animationend", function () {
		textAppear(".artist-content", ".artist-header");
	});

	//function to reset animations
	function resetAnimation() {
		//SELECT TARGET ELEMENTS
		//REMOVE ANIMATION CLASS

		//sketch artist
		var sketchImg1 = document.querySelector(".sketch-img1");
		var sketchImg2 = document.querySelector(".sketch-img2");
		var sketchHeading = document.querySelector(".sketch-artist-heading");
		var sketchContent = document.querySelector(".sketch-artist-content");

		if (sketchImg1.classList.contains("re-appear")) {
			sketchImg1.classList.remove("re-appear");
		}

		if (sketchImg2.classList.contains("re-appear")) {
			sketchImg2.classList.remove("re-appear");
		}

		if (sketchHeading.classList.contains("text-re-appear")) {
			sketchHeading.classList.remove("text-re-appear");
		}

		if (sketchContent.classList.contains("text-re-appear")) {
			sketchContent.classList.remove("text-re-appear");
		}

		// cartoonist
		var cartoonImg = document.querySelector(".cartoon-img");
		var cartoonHeading = document.querySelector(".cartoon-header");
		var cartoonContent = document.querySelector(".cartoon-content");

		if (cartoonImg.classList.contains("animate-spin")) {
			cartoonImg.classList.remove("animate-spin");
		}

		if (cartoonHeading.classList.contains("text-re-appear")) {
			cartoonHeading.classList.remove("text-re-appear");
		}

		if (cartoonContent.classList.contains("text-re-appear")) {
			cartoonContent.classList.remove("text-re-appear");
		}

		//painter
		var painterImg1 = document.querySelector(".painter-img1");
		var painterImg2 = document.querySelector(".painter-img2");
		var painterHeader = document.querySelector(".painter-header");
		var painterContent = document.querySelector(".painter-content");

		if (painterImg1.classList.contains("re-appear")) {
			painterImg1.classList.remove("re-appear");
		}
		if (painterImg2.classList.contains("re-appear")) {
			painterImg2.classList.remove("re-appear");
		}
		if (painterHeader.classList.contains("text-re-appear")) {
			painterHeader.classList.remove("text-re-appear");
		}
		if (painterContent.classList.contains("text-re-appear")) {
			painterContent.classList.remove("text-re-appear");
		}

		// digital illustrator
		var digitalImg = document.querySelector(".digital-img");
		var digitalHeading = document.querySelector(".digital-header");
		var digitalContent = document.querySelector(".digital-content");

		if (digitalImg.classList.contains("animate-spin")) {
			digitalImg.classList.remove("animate-spin");
		}

		if (digitalHeading.classList.contains("text-re-appear")) {
			digitalHeading.classList.remove("text-re-appear");
		}

		if (digitalContent.classList.contains("text-re-appear")) {
			digitalContent.classList.remove("text-re-appear");
		}

		//graphics designer
		var designerImg1 = document.querySelector(".designer-img1");
		var designerImg2 = document.querySelector(".designer-img2");
		var designerHeader = document.querySelector(".designer-header");
		var designerContent = document.querySelector(".designer-content");

		if (designerImg1.classList.contains("re-appear")) {
			designerImg1.classList.remove("re-appear");
		}
		if (designerImg2.classList.contains("re-appear")) {
			designerImg2.classList.remove("re-appear");
		}
		if (designerHeader.classList.contains("text-re-appear")) {
			designerHeader.classList.remove("text-re-appear");
		}
		if (designerContent.classList.contains("text-re-appear")) {
			designerContent.classList.remove("text-re-appear");
		}

		// artist
		var artistImg = document.querySelector(".artist-img");
		var artistHeading = document.querySelector(".artist-header");
		var artistContent = document.querySelector(".artist-content");

		if (artistImg.classList.contains("animate-spin")) {
			artistImg.classList.remove("animate-spin");
		}
		if (artistHeading.classList.contains("text-re-appear")) {
			artistHeading.classList.remove("text-re-appear");
		}
		if (artistContent.classList.contains("text-re-appear")) {
			artistContent.classList.remove("text-re-appear");
		}

		//about section
		var aboutImg = document.querySelector(".about-img");
		var aboutTxt = document.querySelector(".about-txt");

		if (aboutImg.classList.contains("re-appear")) {
			aboutImg.classList.remove("re-appear");
		}
		if (aboutTxt.classList.contains("text-re-appear")) {
			aboutTxt.classList.remove("text-re-appear");
		}
	}
	//Reset animations when back-to-top arrow is clicked
	var backToTopArrow = document.querySelector(".to-top-arrow");
	backToTopArrow.addEventListener("click", resetAnimation);

/*=====================================================
		Animate About section
======================================================*/
	//Function to animate about img
	function animateAboutImg() {
		const about = document.querySelector(".about-img");
		var aboutPosition = about.getBoundingClientRect().top;
		var screenPosition = window.innerHeight / 2.1;

		if (aboutPosition < screenPosition) {
			about.classList.add("re-appear");
		}
	}
	window.addEventListener("scroll", animateAboutImg);

	//animate About paragraph
	var aboutImage = document.querySelector(".about-img");
	aboutImage.addEventListener("animationend", function () {
		var aboutTxt = document.querySelector(".about-txt");
		aboutTxt.classList.add("text-re-appear");
	});
});
