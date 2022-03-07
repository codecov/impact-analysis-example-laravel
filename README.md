# Laravel RTI Example

[![codecov](https://codecov.io/gh/codecov/laravel-rti-example/branch/main/graph/badge.svg?token=EDLK9jZLMH)](https://codecov.io/gh/codecov/laravel-rti-example)

A repository demonstrating how to use Codecov's [Runtime Insights](https://about.codecov.io/product/feature/runtime-insights/) feature with the Laravel framework. This example repository leverages the [codecov/laravel-codecov-opentelemetry](https://github.com/codecov/laravel-codecov-opentelemetry) package to send information to Codecov's Runtime Insights API. It is recommended to view the README for that package to learn more about Runtime Insights.

This repository is not intended to be used directly, but rather referred to as a reference for how to integrate Runtime Insights into your own Laravel projects.

## Requirements and Pre-requisites

1. A repository that is active on [Codecov](https://codecov.io)
2. A profiling token obtainable from Codecov.
3. PHP version >=7.4
4. pcov installed as a PHP extension

A profiling token can be obtained by applying to and being selected for our [Runtime Insights Early Access Program](https://about.codecov.io/product/feature/runtime-insights/).

pcov installation varies depending on the underlying system, you can see how it is installed in this project -- and other Ubuntu-like distros -- by [examining its Dockerfile](https://github.com/codecov/laravel-rti-example/blob/main/phpdocker/php-fpm/Dockerfile#L2).

Alternative installation methods for pcov, including for other distributions of Linux, can be found in the codecov/laravel-codecov-opentelemetry [documentation](https://github.com/codecov/laravel-codecov-opentelemetry#system-dependencies).

## Installation

The package can be installed with:

```
composer require codecov/laravel-codecov-opentelemetry:^0.1
```

It is _not_ recommended to use `dev-main` as, due to the pace of development against the `main` branch, it is frequently unstable. 

## Required Configuration

The codecov/laravel-codecov-opentelemetry package provides a configuration file that can be published via

```
php artisan vendor:publish
```

and selecting the `Codecov\\LaravelCodecovOpenTelemetry` package from the list that appears.

### Environment Variables

After installing the `codecov/laravel-codecov-opentelemetry` package, at a minimum your project should include the following environment variables:

```
CODECOV_OTEL_PROFILING_TOKEN=<your-profiling-token>
CODECOV_OTEL_SERVICE_NAME=example-app
```

Additionally, you may want to set the following variables in order to control how often runtime information is uploaded to Codecov:

```
CODECOV_OTEL_TRACKED_SPANS_SAMPLE_RATE=<range from 0 to 100>
CODECOV_OTEL_UNTRACKED_SPANS_SAMPLE_RATE=<range from 0 to 100>
```

For both of these variables, the default is `10`, which is generally a good baseline. If your application receives a large degree of traffic, you may want to use a number lower than 10. Conversely, if your application is not highly used, you may want to use a larger number.

Other environment variables can be found [in the documentation](https://github.com/codecov/laravel-codecov-opentelemetry#configuration).

### Codecov.yml Configuration

Some configuration is required in the `codecov.yml` to see Runtime Insights results in Pull Request comments. The full specification can be [found in our public documentation](https://docs.codecov.com/docs/runtime-insights#codecovyml-configuration), but the minimum is as follows:

```
comment:
  layout: "reach,diff,flags,tree,betaprofiling"
  show_critical_paths: true
```

Providing these settings in the `codecov.yml` will ensure that impacted files are marked as critical and impacted entrypoints are also shown in the Pull Request comment.

## How to Integrate

Generally, you need to integrate codecov/laravel-codecov-opentelemetry as a Laravel middleware. Once integrated, it can be used like any other Laravel middleware, being selectively applied to certain endpoints, groups of endpoints, or all endpoints. It is recommended, however, to apply the middleware on endpoints of interest that are maintained by your team as opposed to those that ship out of the box with Laravel (e.g., `/login`, `/register`, etc).

You can see how this application integrates Runtime Insights by viewing the [route middleware](https://github.com/codecov/laravel-rti-example/blob/main/example-app/app/Http/Kernel.php#L66), and [web routes](https://github.com/codecov/laravel-rti-example/blob/main/example-app/routes/web.php#L15). Additional information can be found in the [codecov/laravel-codecov-opentelemetry project](https://github.com/codecov/laravel-codecov-opentelemetry#usage).
