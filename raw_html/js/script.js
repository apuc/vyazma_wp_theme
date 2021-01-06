let menuButton = document.querySelector("#menu");

document.getElementById("menu").onclick = function () {
	open()
};
document.getElementById("navOverlay").onclick = function () {
	open()
};

function open() {
	document.getElementById("navigationMenu").classList.toggle("active");
	document.querySelector(".nav_overlay").classList.toggle("activeOverlay")
	menuButton.classList.toggle("hamburger-active");
}


/** Перенос текста в другой блок home-page */
function transferEl(el, parentEl, minWidth, maxWidth) {
	const width = window.innerWidth;

	if (el && parentEl) {
		/** проверка на существование элементов */
		width <= minWidth ? parentEl.appendChild(el) : false;
		width >= maxWidth ? parentEl.appendChild(el) : false
	}
}

const vk = document.querySelector(".transferJs");
const containerVk = document.querySelector(".container_content");
transferEl(vk, containerVk, 937);

window.onload = function () {



	if (document.querySelector("#addOldArticle")) {
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
	}

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

