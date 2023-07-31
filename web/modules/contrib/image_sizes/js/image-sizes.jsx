(({ behaviors }, loadImage, loadedImage) => {
  const debounces = [];
  function triggerEvent(e) {
    if (!debounces[e]) {
      debounces[e] = Drupal.debounce(function () {
        var event = new Event("image:size-check", {
          bubbles: false,
          cancelable: true,
        });
        e.dispatchEvent(event);
      }, 100);
    }
    debounces[e]();
  }

  function data(e) {
    return JSON.parse(e.getAttribute("data-src"));
  }

  behaviors.imageSizesBehavior = {
    attach(context) {
      const images = Array.prototype.slice.call(
        context.querySelectorAll("img.image-sizes")
      );
      const imgs = images.filter((v) => !v.classList.contains("load-always"));
      const loadImgs = images.filter((v) =>
        v.classList.contains("load-always")
      );

      let resizeObserver = new ResizeObserver((entries) => {
        for (let i = 0; i < entries.length; i++) {
          let imgs = Array.prototype.slice.call(
            entries[i].target.querySelectorAll("img.image-sizes")
          );
          for (let ii = 0; ii < imgs.length; ii++) {
            triggerEvent(imgs[ii]);
          }
        }
      });

      for (let i = 0; i < images.length; i++) {
        images[i].addEventListener("image:size-check", function () {
          imageSizesSetUrl(this);
        });
        resizeObserver.observe(images[i].parentNode);
      }

      let observer = new IntersectionObserver((entries, imageObserver) => {
        for (let i = 0; i < entries.length; i++) {
          const entry = entries[i];
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            imageObserver.unobserve(entry.target);
            triggerEvent(entry.target);
            resizeObserver.observe(entry.target.parentNode);
          }
        }
      });

      for (let i = 0; i < imgs.length; i++) {
        observer.observe(imgs[i]);
      }
      for (let i = 0; i < loadImgs.length; i++) {
        triggerEvent(loadImgs[i]);
      }
    },
  };
  function setImage(ele, src, width, height) {
    ele.src = src;
    ele.setAttribute("width", width);
    ele.setAttribute("height", height);
    ele.classList.remove("pre-load");
    ele.classList.remove("loading");
    ele.classList.add("fade-in-on-load");
    triggerEvent(ele);
  }

  function shouldLoadingImage(ele) {
    if (
      ele.classList.contains("load-always") ||
      ele.classList.contains("is-visible")
    ) {
      return true;
    }
    return false;
  }

  function imageSizesSetUrl(ele) {
    if (!shouldLoadingImage(ele)) {
      return;
    }
    var width = parseFloat(
      getComputedStyle(ele.parentNode, null).width.replace("px")
    );
    var conf = data(ele);
    var newUrl = false;
    let urlsSet = Object.keys(conf).filter((v) => {
      if (v >= width) {
        return v;
      }
    });
    if (urlsSet.length > 0) {
      newUrl = conf[urlsSet[0]];
    }

    if (newUrl == false) {
      newUrl = ele.getAttribute("data-src-fallback");
    }
    if (newUrl !== ele.src) {
      if (loadedImage.has(newUrl)) {
        const dim = loadedImage.get(newUrl);
        setImage(ele, newUrl, dim.width, dim.height);
        return;
      }
      if (loadImage.has(newUrl)) {
        var eles = loadImage.get(newUrl);
        eles.push(ele);
        ele.classList.add("loading");
        return;
      } else {
        loadImage.set(newUrl, [ele]);
      }
      const img = new Image();
      ele.classList.add("loading");
      img.addEventListener("load", function () {
        const eles = loadImage.get(this.src);
        for (let i = 0; i < eles.length; i++) {
          const e = eles[i];
          setImage(e, this.src, img.naturalWidth, img.naturalHeight);
          loadedImage.set(this.src, {
            width: img.naturalWidth,
            height: img.naturalHeight,
          });
        }
      });
      img.src = newUrl;
    }
  }
})(Drupal, new Map(), new Map());
