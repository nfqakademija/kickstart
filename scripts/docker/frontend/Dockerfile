FROM node:9.10.0

LABEL maintainer "Aurelijus Banelis <aurelijus@banelis.lt>"

# Install dependencies
RUN apt-get update \
 && apt-get install -y git \
 && rm -rf /var/lib/apt/lists/*

# Not root user
USER node
ENV HOME /home/node

WORKDIR /code
VOLUME /code

CMD '/bin/bash'