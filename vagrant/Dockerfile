FROM ubuntu:trusty

RUN apt-get update -q && apt-get install -q -y --no-install-recommends \
  openssh-server \
  sudo

RUN mkdir /var/run/sshd
EXPOSE 22

RUN useradd vagrant --create-home --shell /bin/bash && echo -n 'vagrant:vagrant' | chpasswd
RUN mkdir -p /home/vagrant/.ssh
RUN echo 'ssh-rsa AAAAB3NzaC1yc2EAAAABIwAAAQEA6NF8iallvQVp22WDkTkyrtvp9eWW6A8YVr+kz4TjGYe7gHzIw+niNltGEFHzD8+v1I2YJ6oXevct1YeS0o9HZyN1Q9qgCgzUFtdOKLv6IedplqoPkcmF0aYet2PkEDo3MlTBckFXPITAMzF8dJSIFo9D8HfdOV0IAdx4O7PtixWKn5y2hMNG0zQPyUecp4pzC6kivAIhyfHilFR61RGL+GPXQ2MWZWFYbAGjyiYJnAmCP3NOTd0jMZEnDkbUvxhMmBYSdETk1rRgm+R4LOzFUGaHqHDLKLX+FIPKcF96hrucXzcWyLbIbEgE98OHlnVYCzRdK8jlqm8tehUc9c9WhQ== vagrant insecure public key' >> /home/vagrant/.ssh/authorized_keys
RUN chown -R vagrant:vagrant /home/vagrant
RUN chmod -R go= /home/vagrant/.ssh
RUN adduser vagrant sudo && echo '%sudo ALL=(ALL:ALL) NOPASSWD: ALL' > /etc/sudoers.d/sudo-nopasswd

RUN locale-gen en_US.utf8
RUN echo 'export LC_ALL=en_US.utf8' >> /home/vagrant/.profile

CMD /usr/sbin/sshd -D
