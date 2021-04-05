  formatNumberSuffixed: (number, precision, options = {}) ->
    suffixes = ['', 'k', 'm', 'b', 't']
    k = 1000

    format = (n) ->
      options ?= {}

      if precision?
        options.minimumFractionDigits = precision
        options.maximumFractionDigits = precision

      n.toLocaleString 'en', options

    return "#{format number}" if (number < k)

    i = Math.min suffixes.length - 1, Math.floor(Math.log(number) / Math.log(k))
    "#{format(number / Math.pow(k, i))}#{suffixes[i]}"
