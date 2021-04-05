export function formatNumberSuffixed(num?: number, precision?: number, options?: Intl.NumberFormatOptions) {
  const suffixes = ['', 'k', 'm', 'b', 't'];
  const k = 1000;

  const format = (n: number) => {
    options ??= {};

    if (precision != null) {
      options.minimumFractionDigits = precision;
      options.maximumFractionDigits = precision;
    }

    return n.toLocaleString('en', options);
  };

  if (num < k) return format(num);

  const i = Math.min(suffixes.length - 1, Math.floor(Math.log(num) / Math.log(k)));

  return `${format(num / Math.pow(k, i))}${suffixes[i]}`;
}
