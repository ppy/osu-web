import OsuCore from 'osu-core';

describe('Something happened', () => {
  it('should create things', () => {
    expect(new OsuCore(window)).not.toBeNull();
  });
});
