let menuButton = document.querySelector("#menu");
menuButton.addEventListener("click", function () {
	menuButton.classList.toggle("hamburger-active");
});


document.getElementById("menu").onclick = function () {
	open()
};
document.getElementById("navOverlay").onclick = function () {
	open()
};

function open() {
	document.getElementById("navigationMenu").classList.toggle("active");
	document.querySelector(".nav_overlay").classList.toggle("activeOverlay")
}

window.onload = function () {

	document.querySelector("#addOldArticle").addEventListener("click", function () {
		let linkImg = "./img/OldArticle1.png";
		let linkTitle = "Название статьи Название статьи";
		let articleText = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad mi";
		let template = {
			articleOld: `
						<article class="oldSingleArticle">
							<img class="oldArticleImg" src="{linkImg}" alt="">
		<div>
		<a href="" class="oldSingleArticle_title">{linkTitle}</a>
		<p class="oldSingleArticle_description">{articleText}</p>
		</div>
		</article>`
		};

		let onceOldArticleGenerate = template.articleOld
			.replace("{linkImg}", linkImg)
			.replace("{linkTitle}", linkTitle)
			.replace("{articleText}", articleText);

		let areaInstall = document.querySelector(".add_OlderArticle");
		areaInstall.innerHTML += onceOldArticleGenerate;
	});

	/*
		const iframeVkApi = document.querySelector("#vkwidget1");
		console.log(iframeVkApi);
		const iframeDocument = iframeVkApi.contentWindow;
		console.log(iframeDocument);
		let iframeVkApiKek = async function (iframeVkApi) {
			await console.log(iframeVkApi);
		};
		iframeVkApiKek(iframeVkApi);
	*/


};


