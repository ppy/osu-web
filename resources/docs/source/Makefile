outputs = ../css/style.css ../css/fonts ../images ../js/all.js
.PHONY: all clean deps
all: deps $(outputs)

clean:
	rm -rf $(outputs)

deps:
	yarn

../css/style.css:
	mkdir -p $(@D)
	yarn stylus -o $@ --include-css assets/stylus/style.styl

../css/fonts:
	mkdir -p $(@D)
	cp -R assets/stylus/fonts $@

../images:
	cp -R assets/images $@

../js/all.js:
	mkdir -p $(@D)
	cat \
		assets/js/lib/energize.js \
		assets/js/lib/jquery.min.js \
		assets/js/lib/imagesloaded.min.js \
		assets/js/lib/highlight.min.js \
		assets/js/lib/jquery.highlight.js \
		assets/js/lib/jquery_ui.js \
		assets/js/lib/jquery.tocify.js \
		assets/js/lib/lunr.js \
		assets/js/script.js \
		> $@
