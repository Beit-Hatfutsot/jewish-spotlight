FROM node:8
RUN apt-get update && apt-get install -y ruby-sass && npm install -g grunt-cli
WORKDIR /usr/src/app
COPY bhjs-content/themes/bhjs/package.json /usr/src/app/bhjs-content/themes/bhjs/package.json
RUN cd /usr/src/app/bhjs-content/themes/bhjs && npm install
COPY . /usr/src/app
RUN cd /usr/src/app/bhjs-content/themes/bhjs && grunt
CMD ["bash", "-c", "rm -rf /data/jewish-spotlight/* && cp -r * /data/jewish-spotlight/"]
