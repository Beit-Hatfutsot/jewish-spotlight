FROM nginx
COPY nginx.default.conf.template /nginx.default.conf.template
COPY templater.sh /templater.sh
CMD ["bash", "-c", "bash /templater.sh /nginx.default.conf.template > /etc/nginx/conf.d/default.conf && exec nginx -g 'daemon off;'"]
